<?php

namespace App\Jobs;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Mission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class GenerateMissionReportPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mission;

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

            if (!file_exists(public_path('exported\missions\\' . $this->filename()))) {
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
            }
        } catch (\Throwable $th) {
            echo "<pre>";
            echo $th->getMessage();
            echo "</pre>";
        }
        return $this->filepath();
    }

    private function reference()
    {
        return str_replace('/', '-', $this->mission->reference) . '-' . str_replace(' ', '', $this->mission->agency->name);
    }

    private function filepath($relative = true)
    {
        $relativePath = 'exported\missions\\' . $this->filename();
        return $relative ? $relativePath : public_path($relativePath);
    }

    private function filename()
    {
        return strtolower('rapport_mission-' . $this->reference() . '.pdf');
    }

    private function loadProcesses(Mission $mission, bool $paginated = false, bool $formated = false, bool $onlyWhereAnomaly = false)
    {
        $mission->unsetRelations();
        $processes = DB::table('processes as p');
        $processes = $processes->selectRaw("p.id as process_id, p.name as process, d.name as domain, f.name as family, f.id as family_id, d.id as domain_id,COUNT(cp.id) as control_points_count, AVG(md.score) as avg_score, FORMAT(MAX(md.executed_at), 'dd-MM-yyyy') AS executed_at, COUNT(md.id) AS total_mission_details, COUNT(CASE WHEN md.score IS NOT NULL THEN md.id ELSE NULL END) AS scored_mission_details, (COUNT(CASE WHEN md.score IS NOT NULL THEN md.id ELSE NULL END) / COUNT(md.id)) * 100 AS progress_status");
        $processes = $processes->join('control_points as cp', 'p.id', '=', 'cp.process_id')
            ->join('domains as d', 'd.id', '=', 'p.domain_id')
            ->join('famillies as f', 'f.id', '=', 'd.familly_id')
            ->join('mission_details as md', 'cp.id', '=', 'md.control_point_id')
            ->join('missions as m', 'm.id', '=', 'md.mission_id')
            ->groupBy('f.id', 'd.id', 'p.id', 'p.name', 'd.name', 'f.name')
            ->where('m.id', $mission->id);
        $processes = !hasRole(['cdc', 'ci']) && $onlyWhereAnomaly ? $processes->whereIn('md.score', [2, 3, 4]) : $processes;
        $processes = $processes->orderBy('f.id')->orderBy('p.id')->get();
        $search = request()->has('search') ? request()->search : false;
        if ($search) {
            $processes = $processes->filter(fn ($processe) => preg_match('/' . strtolower($search) . '/', strtolower($processe->process)));
        }
        if ($formated) {
            $processes = formatForSelect($processes->toArray());
        }
        return $processes;
    }
}
