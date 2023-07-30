<?php

namespace App\Jobs;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Mission;
use App\Models\User;
use App\Notifications\ReportNotification;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class GenerateMissionReportPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

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
            $this->mission->unsetRelations();
            $this->mission->load(['details', 'campaign']);
            $details = $this->mission->details()->whereIn('score', [1, 2, 3, 4])->get()->groupBy('familly.name');
            $end = now();
            $difference = $end->diffInRealMilliseconds($start);
            $campaign = $this->mission->campaign;
            $stats = [
                'avg_score' => $this->mission->avg_score,
                'total_processes' => $this->loadProcesses($this->mission)->count(),
                'total_anomalies' => $this->mission->details()->whereAnomaly()->count(),
                'total_major_facts' => $this->mission->details()->onlyMajorFacts()->count(),
            ];

            if (!file_exists($this->filepath())) {
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
                $pdf->save($this->filepath());
                $notify = User::whereRoles(['cdcr', 'dg', 'cdrcp', 'ig', 'sg', 'der', 'dcp']);
                $notify = User::whereRoles(['dre'])->whereRelation('agencies', 'agencies.id', $mission->agency_id)->get()->merge($notify->get());
                $notify = $notify->merge($mission->dcpControllers)->merge($mission->dreControllers);
                foreach ($notify as $user) {
                    Notification::send($user, new ReportNotification($this->mission));
                }
            } else {
                redirect($this->filepath());
            }
        } catch (\Throwable $th) {
            $this->response['message'] = $th->getMessage() . ' on line ' . $th->getLine() . ' on file ' . $th->getFile();
            $this->response['status'] = false;
        }
        $this->response['message'] = $th->getMessage() . ' on line ' . $th->getLine() . ' on file ' . $th->getFile();
        $this->response['status'] = false;
        $this->response['file_path'] = $this->filepath();
    }

    public function getResponse()
    {
        return $this->response;
    }


    /**
     * Generate file path
     *
     * @param bool $relative
     *
     * @return string
     */
    private function filepath($relative = true): string
    {
        $relativePath = __DIR__ . '\..\..\public\exported\missions\\' . $this->mission->report_name . '.pdf';
        return $relative ? $relativePath : public_path($relativePath);
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
