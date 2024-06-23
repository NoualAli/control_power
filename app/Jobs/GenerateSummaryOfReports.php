<?php

namespace App\Jobs;

use App\Exports\SynthesisExport;
use App\Exports\SynthesisWithReportsExport;
use App\Models\ControlCampaign;
use App\Models\MissionDetail;
use App\Models\User;
use App\Notifications\FileGeneratedNotification;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use stdClass;

class GenerateSummaryOfReports implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    public $tries = 3;

    private $withReports;

    private $user;

    private $campaign;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, string $campaign, bool $withReports = false)
    {
        $this->withReports = $withReports;
        $this->user = $user;
        $this->campaign = $campaign;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $start = now();
            $controlCampaign = DB::table('control_campaigns AS cc')->select('cc.id', 'cc.reference', DB::raw('COUNT(cp.id) AS total_control_points'))
                ->leftJoin('control_campaign_processes AS ccp', 'cc.id', 'ccp.control_campaign_id')
                ->leftJoin('control_points AS cp', 'ccp.process_id', 'cp.process_id')
                ->where('cc.id', $this->campaign)->groupBy('cc.id', 'cc.reference')->first();

            $filename = $this->withReports ? 'récapitulatif-des-constats-' . $controlCampaign->reference . '.xlsx' : 'récapitulatif-des-notations-' . $controlCampaign->reference . '.xlsx';
            print "\n\n  --------------------------------------------------------------------------------------------------------\n\n";
            print_r("  Début de la génération du fichier $filename\n");

            $agencies = DB::table('missions', 'm')->select([
                'd.id as dre_id',
                DB::raw("CONCAT(d.code, ' ', d.name) as dre"),
                'a.id as agency_id',
                DB::raw("CONCAT(a.code, ' ', a.name) as agency"),
            ])
                ->leftJoin('agencies as a', 'a.id', 'm.agency_id')
                ->leftJoin('dres as d', 'd.id', 'a.dre_id')
                ->where('m.control_campaign_id', $controlCampaign->id);


            $dresFromAgencies = (clone $agencies)->select([
                'd.id as dre_id',
                DB::raw("CONCAT(d.code, ' - ', d.name) as dre"),
            ])->groupBy('d.id', 'd.name', 'd.code')
                ->orderBy('d.code')
                ->orderBy('d.name')
                ->get();

            $missionDetails = DB::table('control_campaigns', 'cc')->select([
                'f.name as family',
                'd.name as domain',
                'p.name as process',
                'cp.name as control_point',
                'md.id',
                'score',
                'is_disabled',
                'reg_is_regularized',
                DB::raw("CONCAT(dres.code, ' ', dres.name) as dre"),
                DB::raw("CONCAT(a.code, ' ', a.name) as agency"),
                'a.id as agency_id'
            ])
                ->leftJoin('missions as m', 'm.control_campaign_id', 'cc.id')
                ->leftJoin('mission_details as md', 'md.mission_id', 'm.id')
                ->leftJoin('agencies as a', 'a.id', 'm.agency_id')
                ->leftJoin('dres', 'dres.id', 'a.dre_id')
                ->leftJoin('control_points as cp', 'cp.id', 'md.control_point_id')
                ->leftJoin('processes as p', 'p.id', 'cp.process_id')
                ->leftJoin('domains as d', 'd.id', 'p.domain_id')
                ->leftJoin('families as f', 'f.id', 'd.family_id')
                ->where('cc.id', $this->campaign)
                ->whereIn('score', [1, 2, 3, 4])
                ->where('is_disabled', false)
                ->orderBy('f.id')
                ->orderBy('d.id')
                ->orderBy('p.id')
                ->orderBy('cp.name');
            if (hasRole('cdc')) {
                $missionDetails = $missionDetails->whereIn('a.id', auth()->user()->agencies->pluck('id')->toArray());
            }
            $dres = collect([]);
            foreach ($dresFromAgencies as $dre) {
                $dreAgencies = (clone $agencies)->where('dre_id', $dre->dre_id)->get();
                if ($dreAgencies->count()) {
                    $single_dre = new stdClass;
                    $single_dre->dre = $dre->dre;
                    $dreAgencies = $dreAgencies;
                    $single_dre->agencies = $dreAgencies;
                    $single_dre->total_agencies = $dreAgencies->count();
                    $single_dre->agencies = $dreAgencies;
                    foreach ($single_dre->agencies as $agency) {
                        if ($this->withReports) {
                            $missionDetails = $missionDetails->addSelect('recovery_plan');
                        }

                        $agency->data = (clone $missionDetails)->where('dres.id', $dre->dre_id)->where('a.id', $agency->agency_id)->get();

                        if ($this->withReports) {
                            $agency->data->map(function ($item) {
                                $observation = DB::table('comments')->where('commentable_type', MissionDetail::class)->where('commentable_id', $item->id)->whereIn('type', ['ci_observation', 'cdc_observation'])
                                    ->orderBy('created_at', 'DESC')->first();
                                $item->observation = $observation->content;
                                return $item;
                            });
                        }
                    }
                    $dres->push($single_dre);
                }
            }

            $controlPoints = DB::table('control_campaign_processes', 'ccp')
                ->select([
                    'f.name as family',
                    'd.name as domain',
                    'p.name as process',
                    'cp.name as control_point',
                    'cp.id',
                ])
                ->leftJoin('processes as p', 'p.id', 'ccp.process_id')
                ->leftJoin('control_points as cp', 'p.id', 'cp.process_id')
                ->leftJoin('domains as d', 'd.id', 'p.domain_id')
                ->leftJoin('families as f', 'f.id', 'd.family_id')
                ->where('ccp.control_campaign_id', $this->campaign)
                ->orderBy('f.id')
                ->orderBy('d.id')
                ->orderBy('p.id')
                ->orderBy('cp.id')
                ->get();

            $end = now();
            $difference = $end->diffInMinutes($start);
            if ($difference < 1) {
                $difference = $end->diffInSeconds($start);
                $difference = $difference > 1 ? $difference . ' secondes' : $difference . ' seconde';
            } else {
                $difference = $difference > 1 ? $difference . ' minutes' : $difference . ' minute';
            }

            print_r("  Fichier " . $filename . " généré avec succès\n");
            print_r("  La génération a prit au total $difference\n");
            $folder = 'public\\exported\campaigns\\' . $controlCampaign->reference;
            $filepath = $folder . '\\' . $filename;
            $category = 'control_campaign_summary';
            if ($this->withReports) {
                $category .= '_reports';
                $result = Excel::store(new SynthesisWithReportsExport(compact('dres', 'controlPoints', 'controlCampaign')), $filepath);
            } else {
                $result = Excel::store(new SynthesisExport(compact('dres', 'controlPoints', 'controlCampaign')), $filepath);
                $category .= '_scores';
            }
            if ($result) {
                Notification::send($this->user, new FileGeneratedNotification($filepath, $filename, $difference));
                $id = Str::uuid();
                $insertedFile = DB::table('media')->updateOrInsert([
                    'id' => $id,
                    'original_name' => $filename,
                    'hash_name' => $filename,
                    'folder' => str_replace('public', 'storage', $folder),
                    'extension' => 'pdf',
                    'mimetype' => 'application/pd',
                    'size' => Storage::fileSize($filepath),
                    'created_at' => now(),
                    'category' => $category,
                    'payload' => json_encode([
                        'name' => $controlCampaign->reference,
                    ]),
                ]);
                $media = DB::table('has_media')->updateOrInsert([
                    'attachable_id' => $controlCampaign->id,
                    'attachable_type' => ControlCampaign::class,
                    'media_id' => $id,
                ]);
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }
}
