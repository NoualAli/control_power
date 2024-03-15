<?php

namespace App\Jobs;

use App\DB\Queries\MissionProcessesQuery;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Mission;
use App\Models\User;
use App\Notifications\ReportNotification;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GenerateMissionReportPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    public $tries = 3;

    /**
     * @var App\Models\Mission
     */
    protected $mission;

    protected $notify;

    /**
     * @var array
     */
    protected $response = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Mission $mission, $notify = true)
    {
        $this->mission = $mission;
        $this->notify = $notify;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        print "\n\n  --------------------------------------------------------------------------------------------------------\n\n";
        print_r("  Début de la génération du rapport PDF de la mission " . $this->mission->reference . "\n");
        try {
            $fileExists = Storage::fileExists($this->filepath());
            $mission = $this->mission;
            $start = now();
            $mission->unsetRelations();
            $mission->load(['details', 'campaign']);
            $details = $mission->details()->whereIn('score', [1, 2, 3, 4])->get()->map(function ($detail) {
                $detail->observation = $detail->observations()->first() ?: null;
                return $detail;
            })->groupBy('family.name');

            $campaign = $mission->campaign;
            $stats = [
                'avg_score' => $mission->avg_score,
                'total_processes' => $this->loadProcesses($mission)->count(),
                'total_anomalies' => $mission->details()->whereAnomaly()->count(),
                'total_major_facts' => $mission->details()->onlyMajorFacts()->count(),
            ];
            $pdf = Pdf::loadView('export.report', compact('mission', 'campaign', 'details', 'stats'));
            $pdf->render();
            $canvas = $pdf->get_canvas();
            $cpdf = $canvas->get_cpdf();

            $font = $pdf->getFontMetrics()->get_font("helvetica", "bold");

            $firstPageId = $cpdf->getFirstPageId();
            $objects = $cpdf->objects;
            $pages = array_filter($objects, function ($v) {
                return $v['t'] == 'page';
            });
            $number = 1;
            foreach ($pages as $pageId => $page) {
                if (($pageId + 1) !== $firstPageId) {
                    $canvas->reopen_object($pageId + 1);
                    $canvas->text(525, 807, $number, $font, 13, [.07, .34, .25]);
                    $canvas->close_object();
                    $number++;
                }
            }
            $content = $pdf->download()->getOriginalContent();
            Storage::put($this->filepath(), $content);
            $notifiables = User::whereRoles(['cdcr', 'cdrcp', 'dcp'])->where('is_active', true)->get();
            $notifiables = User::whereRoles(['dre', 'da'])->whereRelation('agencies', 'agencies.id', $mission->agency_id)->where('is_active', true)->get()->merge($notifiables);
            $notifiables = $notifiables->merge([$mission->dreController]);
            if ($mission->dcp_controller) {
                $dcpController = $mission->dcp_controller;
                $notifiables = $notifiables->merge($dcpController);
            }
            $end = now();
            $difference = $end->diffInMinutes($start);
            if ($difference < 1) {
                $difference = $end->diffInSeconds($start);
                $difference = $difference > 1 ? $difference . ' secondes' : $difference . ' sconde';
            } else {
                $difference = $difference > 1 ? $difference . ' minutes' : $difference . ' minute';
            }
            /**
             * Store pdf informations in database
             */
            if ($fileExists) {
                $id = Str::uuid();
                $insertedFile = DB::table('media')->updateOrInsert([
                    'id' => $id,
                    'original_name' => $this->getFileName(true),
                    'hash_name' => $this->getFileName(true),
                    'folder' => $this->dirPath(true),
                    'extension' => 'pdf',
                    'mimetype' => 'application/pd',
                    'size' => Storage::fileSize($this->filepath()),
                    'created_at' => now(),
                    'payload' => json_encode([
                        'name' => $mission->reference,
                    ]),
                ]);
                $media = DB::table('has_media')->updateOrInsert([
                    'attachable_id' => $mission->id,
                    'attachable_type' => Mission::class,
                    'media_id' => $id,
                ]);
            }

            /**
             * Notify users after pdf is generated
             */
            if (!$fileExists) {
                foreach ($notifiables as $user) {
                    Notification::send($user, new ReportNotification($mission));
                }
            }
            print_r("  Rapport PDF de la mission " . $this->mission->reference . " généré avec succès sous le nom : " . $this->getFileName(true) . "\n");
            print_r("  La génération a prit au total $difference\n");
        } catch (\Throwable $th) {
            echo $th->getMessage() . ' ' . $th->getLine() . ' ' . $th->getFile();
        }
    }

    /**
     * Generate file path
     *
     * @param bool $relative
     *
     * @return string
     */
    private function filepath(): string
    {
        return $this->dirPath() . '\\' . $this->getFileName(true);
    }

    /**
     * @param bool $relative
     *
     * @return string
     */
    private function dirPath(bool $public_path = false): string
    {
        $relativePath = $public_path ? 'exported\campaigns\\' . $this->mission->campaign->reference . '\\missions' : 'public\\exported\campaigns\\' . $this->mission->campaign->reference . '\\missions';
        if (!Storage::directoryExists($relativePath)) {
            Storage::makeDirectory($relativePath);
        }
        return $relativePath;
    }

    /**
     * @param bool $withExtension
     *
     * @return string
     */
    public function getFileName(bool $withExtension = false): string
    {
        $extension = '';
        if ($withExtension) {
            $extension = '.pdf';
        }
        return  $this->mission->report_name . $extension;
    }

    /**
     * Load processes
     *
     * @param Mission $mission
     * @param bool $paginated
     * @param bool $formated
     * @param bool $onlyWhereAnomaly
     *
     * @return Illuminate\Support\Collection
     */
    private function loadProcesses(Mission $mission, bool $paginated = false, bool $formated = false, bool $onlyWhereAnomaly = false)
    {
        $mission->unsetRelations();
        $processes = (new MissionProcessesQuery($mission))->prepare()->whereIn('md.score', [2, 3, 4])->orderBy('f.id')->orderBy('p.id')->get();

        if ($formated) {
            $processes = formatForSelect($processes->toArray());
        }
        return $processes;
    }
}