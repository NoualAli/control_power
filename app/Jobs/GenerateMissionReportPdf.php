<?php

namespace App\Jobs;

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

    /**
     * @var array
     */
    protected $response = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Mission $mission)
    {
        $this->mission = $mission;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $mission = $this->mission;
            $start = now();
            $mission->unsetRelations();
            $mission->load(['details', 'campaign']);
            $details = $mission->details()->whereIn('score', [1, 2, 3, 4])->get()->groupBy('family.name');
            $campaign = $mission->campaign;
            $stats = [
                'avg_score' => $mission->avg_score,
                'total_processes' => $this->loadProcesses($mission)->count(),
                'total_anomalies' => $mission->details()->whereAnomaly()->count(),
                'total_major_facts' => $mission->details()->onlyMajorFacts()->count(),
            ];

            if (!Storage::exists($this->filepath())) {
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
                $notify = User::whereRoles(['cdcr', 'cdrcp', 'dcp'])->where('is_active', true)->get();
                $notify = User::whereRoles(['dre', 'da'])->whereRelation('agencies', 'agencies.id', $mission->agency_id)->where('is_active', true)->get()->merge($notify);
                $notify = $notify->merge($mission->dcpControllers)->merge($mission->dreControllers);
                $end = now();
                $difference = $end->diffInRealMilliseconds($start);

                /**
                 * Store pdf informations in database
                 */
                if (Storage::fileExists($this->filepath())) {
                    $id = Str::uuid();
                    $insertedFile = DB::table('media')->insert([
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
                    $media = DB::table('has_media')->insert([
                        'attachable_id' => $mission->id,
                        'attachable_type' => Mission::class,
                        'media_id' => $id,
                    ]);
                }

                /**
                 * Notify users after pdf is generated
                 */
                foreach ($notify as $user) {
                    Notification::send($user, new ReportNotification($mission));
                }
            }
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
        $processes = getMissionProcesses($mission)->whereIn('md.score', [2, 3, 4])->orderBy('f.id')->orderBy('p.id')->get();

        if ($formated) {
            $processes = formatForSelect($processes->toArray());
        }
        return $processes;
    }
}