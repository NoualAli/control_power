<?php

namespace App\Statistics\AgencyLevel;

use Illuminate\Support\Facades\DB;

class Anomalies extends StatisticsData
{
    /**
     * Fetch mission anomalies statistics
     *
     * @return array
     */
    public function missions(): array
    {
        $missions = $this->missions
            ->select(DB::raw('COUNT(*) as total_anomalies'), 'm.reference as mission');
        $missions = $missions->leftJoin('mission_details as md', 'md.mission_id', 'm.id');

        $missions = $missions->where('score', '>', 1)
            ->groupBy(['m.reference'])
            ->orderBy('total_anomalies', 'DESC')
            ->take(10)
            ->get()
            ->toArray();
        return $missions;
    }

    /**
     * Fetch campaigns anomalies statistics
     *
     * @return array
     */
    public function campaigns(): array
    {
        $campaigns = DB::table('control_campaigns as c')
            ->select('c.reference as campaign', 'c.id as campaign_id', DB::raw('COUNT(md.score) as total_anomalies'))
            ->join('missions as m', 'c.id', 'm.control_campaign_id')
            ->join('mission_details as md', 'm.id', 'md.mission_id')
            ->where('md.score', '>', 1);

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
        $campaigns = $campaigns->whereNotNull('c.validated_at')->where('c.is_for_testing', false);

        $campaigns = $campaigns->groupBy('c.reference', 'c.id')
            ->orderBy('total_anomalies', 'DESC')
            ->take(10)
            ->get()
            ->toArray();

        return array_values($campaigns);
    }

    /**
     * Fetch families anomalies statistics
     *
     * @return array
     */
    public function families(): array
    {
        $anomalies = $this->details
            ->select(DB::raw('COUNT(*) as count'), 'f.name as family')
            ->join('control_points as cp', 'cp.id', '=', 'md.control_point_id')
            ->join('processes as p', 'p.id', '=', 'cp.process_id')
            ->join('domains as dm', 'dm.id', '=', 'p.domain_id')
            ->join('families as f', 'f.id', '=', 'dm.family_id')
            ->where('md.score', '>', 1)
            ->groupBy('f.name')
            ->orderBy('count', 'DESC')
            ->get();
        $anomalies = $anomalies->mapWithKeys(function ($data, $key) {
            $familyName = $data->family;
            return [$familyName => $data->count];
        });
        $labels = $anomalies->keys();

        $colors = $this->default_colors;

        $datasets = [
            [
                "label" => "Anomalies par familles",
                "data" => $anomalies->values(),
                'backgroundColor' => $colors->backgroundColor,
                'borderColor' => $colors->borderColor,
                'borderWidth' => $colors->borderWidth,
            ]
        ];
        return compact('labels', 'datasets');
    }

    /**
     * Fetch domains anomalies statistics
     *
     * @return array
     */
    public function domains(): array
    {
        $anomalies = $this->details
            ->select(DB::raw('COUNT(*) as total_anomalies'), 'dm.name as domain')
            ->join('control_points as cp', 'cp.id', '=', 'md.control_point_id')
            ->join('processes as p', 'p.id', '=', 'cp.process_id')
            ->join('domains as dm', 'dm.id', '=', 'p.domain_id')
            ->where('md.score', '>', 1)
            ->groupBy('dm.name')
            ->orderBy('total_anomalies', 'DESC')
            ->take(10)
            ->get();
        return $anomalies->toArray();
    }

    /**
     * Fetch dres anomalies statistics
     *
     * @return array
     */
    public function dres(): array
    {
        $anomalies = $this->details
            ->select(DB::raw('COUNT(*) as count'), 'd.name as dre')
            ->where('md.score', '>', 1)
            ->groupBy('d.name')
            ->get()->mapWithKeys(function ($data, $key) {
                $dre = $data->dre;
                return [$dre => $data->count];
            });
        $labels = $anomalies->keys();
        $colors = $this->default_colors;

        $datasets = [
            [
                "label" => "Anomalies par DRE",
                "data" => $anomalies->values(),
                'backgroundColor' => $colors->backgroundColor,
                'borderColor' => $colors->borderColor,
                'borderWidth' => $colors->borderWidth,
            ]
        ];
        return compact('labels', 'datasets');
    }

    /**
     * Fetch agencies anomalies statistics
     *
     * @return array
     */
    public function agencies(): array
    {
        $anomalies = $this->details
            ->select(DB::raw('COUNT(*) as total_anomalies'), DB::raw("CONCAT(a.code, ' - ', a.name) as agency"))
            ->where('md.score', '>', 1)
            ->groupBy(DB::raw("CONCAT(a.code, ' - ', a.name)"))
            ->orderBy('total_anomalies', 'DESC')
            ->take(10)
            ->get()->toArray();
        return array_values($anomalies);
    }
}
