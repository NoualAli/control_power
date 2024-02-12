<?php

namespace App\Statistics;

use Illuminate\Support\Facades\DB;

class Scores extends StatisticsData
{
    /**
     * Fetch scores statistics
     *
     * @return array
     */
    public function global(): array
    {
        $colors = $this->default_colors;
        $details = $this->details->select(['score', DB::raw('COUNT(*) as scores_count')])->whereNotNull('score');
        $groupBy = ['score'];
        if (hasRole(['ci'])) {
            $details = $details->addSelect('m.assigned_to_ci_id');
            $groupBy = ['score', 'm.assigned_to_ci_id'];
        }
        if (hasRole(['cdc'])) {
            $details = $details->addSelect('created_by_id');
            $groupBy = ['score', 'created_by_id'];
        }

        $details = $details->groupBy($groupBy);
        $details = $details->orderBy('score', 'DESC')->get()->pluck('scores_count', 'score');
        $labels = $details->keys();
        $datasets = [
            [
                'axis' => 'y',
                "label" => "Classement des notations",
                "data" => $details->values(),
                'backgroundColor' => $colors->backgroundColor,
                'borderColor' => $colors->borderColor,
                'borderWidth' => $colors->borderWidth,
            ]
        ];
        return compact('labels', 'datasets');
    }

    /**
     * Get avg scores for each dre
     *
     * @return array
     */
    public function avgByDre(): array
    {
        $scores = $this->details->get()->groupBy('dre')->map(function ($groupedDetails) {
            return [
                'dre' => $groupedDetails->first()->dre,
                'avg_score' => number_format($groupedDetails->avg('score'), 2)
            ];
        })->sortBy('avg_score')
            ->values()->toArray();
        return array_values($scores);
    }

    /**
     * Get avg scores for each family
     *
     * @return array
     */
    public function avgByFamily(): array
    {
        $families = $this->details
            ->select(['f.name as family', DB::raw('CAST(ROUND(AVG(CAST(md.score AS DECIMAL(10, 2))), 2) AS VARCHAR(10)) as avg_score')])
            ->join('control_points as cp', 'cp.id', 'md.control_point_id')
            ->join('processes as p', 'p.id', 'cp.process_id')
            ->join('domains as dm', 'dm.id', 'p.domain_id')
            ->join('families as f', 'f.id', 'dm.family_id')
            ->groupBy(['f.name'])->get()->map(fn ($data) => [$data->family => number_format($data->avg_score, 2)])->collapse();
        $labels = $families->keys();

        $colors = $this->default_colors;
        $datasets = [
            [
                "label" => "Anomalies par mission",
                "data" => $families->values(),
                'backgroundColor' => $colors->backgroundColor,
                'borderColor' => $colors->borderColor,
                'borderWidth' => $colors->borderWidth,
            ]
        ];
        return compact('labels', 'datasets');
    }

    /**
     * Get avg scores for each domain
     *
     * @return array
     */
    public function avgByDomain(): array
    {
        $domains = $this->details
            ->select(['dm.name as domain', DB::raw('CAST(ROUND(AVG(CAST(md.score AS DECIMAL(10, 2))), 2) AS VARCHAR(10)) as avg_score')])
            ->join('control_points as cp', 'cp.id', 'md.control_point_id')
            ->join('processes as p', 'p.id', 'cp.process_id')
            ->join('domains as dm', 'dm.id', 'p.domain_id')
            ->groupBy(['dm.name'])->orderBy('avg_score', 'DESC')->get()->map(fn ($item) => ['domain' => $item->domain, 'avg_score' => number_format($item->avg_score, 2)])->toArray();
        return $domains;
    }
}
