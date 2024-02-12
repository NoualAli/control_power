<?php

namespace App\Statistics;

use Illuminate\Support\Facades\DB;

class MajorFacts extends StatisticsData
{
    /**
     * Fetch mission major facts statistics
     *
     * @return array
     */
    public function missions(): array
    {
        $missions = $this->major_facts->select(DB::raw('COUNT(CASE WHEN md.major_fact_is_dispatched_at IS NOT NULL THEN 1 ELSE 0 END)  as total_major_facts'), 'm.reference as mission');
        $missions = $missions
            ->groupBy('m.reference')
            ->orderBy('total_major_facts', 'DESC')
            ->take(10)
            ->get()
            ->toArray();
        return array_values($missions);
    }

    /**
     * Fetch campaigns major facts statistics
     *
     * @return array
     */
    public function campaigns(): array
    {
        $campaigns = DB::table('control_campaigns as c')
            ->select('c.reference as campaign', 'c.id as campaign_id', DB::raw('COUNT(md.id) as total_major_facts'))
            ->join('missions as m', 'c.id', 'm.control_campaign_id')
            ->join('mission_details as md', 'm.id', 'md.mission_id')
            ->where('md.score', '>', 1)
            ->whereNull('c.deleted_at');

        $user = auth()->user();
        if (hasRole('ci')) {
            $campaigns = $campaigns->join('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id')
                ->where(fn ($query) => $query->where('m.assigned_to_ci_id', $user->id)->orWhere('mhc.user_id', $user->id));
        } elseif (hasRole('cdc')) {
            $campaigns = $campaigns->where('m.created_by_id', $user->id);
        } elseif (hasRole('da')) {
            $campaigns = $campaigns->whereIn('m.agency_id', $user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole('dre')) {
            $campaigns = $campaigns->whereIn('m.agency_id', $user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
        }

        $campaigns = $campaigns->whereNotNull('c.validated_at')->where('c.is_for_testing', false)->whereNotNull('md.major_fact_is_dispatched_at')->where('md.is_disabled', false)->whereNull('m.deleted_at')->where('m.is_for_testing', false);

        $campaigns = $campaigns->groupBy('c.reference', 'c.id')
            ->orderBy('total_major_facts', 'DESC')
            ->take(10)
            ->get()
            ->toArray();
        return array_values($campaigns);
    }

    /**
     * Fetch families major facts statistics
     *
     * @return array
     */
    public function families(): array
    {
        $majorFacts = $this->major_facts
            ->select(DB::raw('COUNT(*) as count'), 'f.name as family')
            ->join('control_points as cp', 'cp.id', '=', 'md.control_point_id')
            ->join('processes as p', 'p.id', '=', 'cp.process_id')
            ->join('domains as dm', 'dm.id', '=', 'p.domain_id')
            ->join('families as f', 'f.id', '=', 'dm.family_id')
            ->groupBy('f.name')
            ->orderBy('count', 'DESC')
            ->get();

        $majorFacts = $majorFacts->mapWithKeys(function ($data, $key) {
            $familyName = $data->family;
            return [$familyName => $data->count];
        });

        $labels = $majorFacts->keys();

        $colors = $this->default_colors;

        $datasets = [
            [
                "label" => "Faits majeurs par familles",
                "data" => $majorFacts->values(),
                'backgroundColor' => $colors->backgroundColor,
                'borderColor' => $colors->borderColor,
                'borderWidth' => $colors->borderWidth,
            ]
        ];
        return compact('labels', 'datasets');
    }

    /**
     * Fetch domains major facts statistics
     *
     * @return array
     */
    public function domains(): array
    {
        $domains = $this->major_facts
            ->select(DB::raw('COUNT(md.id) as total_major_facts'), 'dm.name as domain')
            ->join('control_points as cp', 'cp.id', '=', 'md.control_point_id')
            ->join('processes as p', 'p.id', '=', 'cp.process_id')
            ->join('domains as dm', 'dm.id', '=', 'p.domain_id')
            ->groupBy('dm.name')
            ->orderBy('total_major_facts', 'DESC')
            ->take(10)
            ->get();

        return $domains->toArray();
    }

    /**
     * Fetch dres major facts statistics
     *
     * @return array
     */
    public function dres(): array
    {
        $majorFacts = $this->major_facts
            ->select(DB::raw('COUNT(md.id) as count'), 'd.name as dre')
            ->groupBy('d.name')
            ->get()->mapWithKeys(function ($data, $key) {
                $dre = $data->dre;
                return [$dre => $data->count];
            });
        $labels = $majorFacts->keys();
        $colors = $this->default_colors;

        $datasets = [
            [
                "label" => "Faits majeurs par DRE",
                "data" => $majorFacts->values(),
                'backgroundColor' => $colors->backgroundColor,
                'borderColor' => $colors->borderColor,
                'borderWidth' => $colors->borderWidth,
            ]
        ];
        return compact('labels', 'datasets');
    }

    /**
     * Fetch agencies major facts statistics
     *
     * @return array
     */
    public function agencies(): array
    {
        $majorFacts = $this->major_facts
            ->select(DB::raw('COUNT(*) as total_major_facts'), DB::raw("CONCAT(a.code, ' - ', a.name) as agency"))
            ->groupBy(DB::raw("CONCAT(a.code, ' - ', a.name)"))
            ->orderBy('total_major_facts', 'DESC')
            ->take(10)
            ->get()->toArray();
        return array_values($majorFacts);
    }
}
