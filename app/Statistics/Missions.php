<?php

namespace App\Statistics;

use Illuminate\Support\Facades\DB;

class Missions extends StatisticsData
{
    /**
     * Fetch missions states
     *
     * @return array
     */
    public function state(): array
    {
        $missions = $this->missions->select('m.id');
        $today = today()->format('Y-m-d');
        $missions = $missions->distinct('m.reference')->select(
            DB::raw('SUM(CASE WHEN m.current_state = 1 THEN 1 ELSE 0 END) as todo'),
            DB::raw('SUM(CASE WHEN m.current_state = 2 OR m.current_state = 3 THEN 1 ELSE 0 END) as active'),
            DB::raw('SUM(CASE WHEN m.current_state = 4 OR m.current_state = 5 OR m.current_state = 6 OR m.current_state = 7 OR m.current_state = 8 THEN 1 ELSE 0 END) as done'),
        );

        // dd($missions->first());
        if (hasRole('ci')) {
            $missions = $missions->addSelect(DB::raw(
                'SUM(CASE
                    WHEN DATEDIFF(day, CAST(programmed_start AS DATE), COALESCE(CAST(ci_validation_at AS DATE), GETDATE())) > (DATEDIFF(wk, CAST(programmed_start AS DATE), COALESCE(CAST(ci_validation_at AS DATE), GETDATE())) * 2) + 15 THEN 1
                    ELSE 0
                END) as delay'
            ));
        } elseif (hasRole('cdc')) {
            $missions = $missions->addSelect(
                DB::raw(
                    'SUM(CASE
                        WHEN DATEDIFF(day, CAST(programmed_start AS DATE), COALESCE(CAST(ci_validation_at AS DATE), GETDATE())) > (DATEDIFF(wk, CAST(programmed_start AS DATE), COALESCE(CAST(ci_validation_at AS DATE), GETDATE())) * 2) + 15 THEN 1
                        WHEN DATEDIFF(day, CAST(programmed_start AS DATE), COALESCE(CAST(cdc_validation_at AS DATE), GETDATE())) > (DATEDIFF(wk, CAST(programmed_start AS DATE), COALESCE(CAST(cdc_validation_at AS DATE), GETDATE())) * 2) + 15 THEN 1
                        ELSE 0
                    END) as delay'
                )
            );
        } else {
            // $missions = $missions->addSelect(DB::raw(
            //     'SUM(CASE
            //         WHEN DATEDIFF(day, CAST(programmed_start AS DATE), COALESCE(CAST(ci_validation_at AS DATE), GETDATE())) > (DATEDIFF(wk, CAST(programmed_start AS DATE), COALESCE(CAST(ci_validation_at AS DATE), GETDATE()))  * 2) + 15 THEN 1
            //         WHEN DATEDIFF(day, CAST(programmed_start AS DATE), COALESCE(CAST(cdc_validation_at AS DATE), GETDATE())) > (DATEDIFF(wk, CAST(programmed_start AS DATE), COALESCE(CAST(cdc_validation_at AS DATE), GETDATE()))  * 2) + 15 THEN 1
            //         WHEN DATEDIFF(day, COALESCE(CAST(dcp_validation_at AS DATE), GETDATE()), COALESCE(CAST(da_validation_at AS DATE), GETDATE())) > (DATEDIFF(wk, COALESCE(CAST(dcp_validation_at AS DATE), GETDATE()), COALESCE(CAST(da_validation_at AS DATE), GETDATE()))  * 2) + 10 THEN 1
            //         ELSE 0
            //     END) as delay'
            // ));
            $missions = $missions->addSelect(DB::raw(
                'SUM(CASE
                    WHEN DATEDIFF(day, CAST(programmed_start AS DATE), COALESCE(CAST(ci_validation_at AS DATE), GETDATE())) > (DATEDIFF(wk, CAST(programmed_start AS DATE), COALESCE(CAST(ci_validation_at AS DATE), GETDATE())) * 2) + 15 THEN 1
                    WHEN DATEDIFF(day, CAST(programmed_start AS DATE), COALESCE(CAST(cdc_validation_at AS DATE), GETDATE())) > (DATEDIFF(wk, CAST(programmed_start AS DATE), COALESCE(CAST(cdc_validation_at AS DATE), GETDATE())) * 2) + 15  THEN 1
                    ELSE 0
                END) as delay'
            ));
        }
        // dd($missions->first());
        // $missions = $missions->groupBy('m.reference');
        // dd($missions->get()->first(), $missions->toSql());
        $missions = $missions->get()->first();

        $todo = $missions?->todo ?: 0;
        $done = $missions?->done ?: 0;
        $delay = $missions?->delay ?: 0;
        $active = $missions?->active ?: 0;
        return compact('delay', 'active', 'todo', 'done');
    }

    /**
     * Fetch missions validations statistics
     *
     * @return array
     */
    public function percentage(): array
    {
        $missions = $this->missions;
        $total = $missions->count();
        $validated = $missions->whereNotNull('cdc_validation_by_id')->count();
        $notValidated = ($total - $validated);

        $labels = ['Rapports validés', 'Rapports non validés'];
        $colors = $this->default_colors;

        $datasets = [
            [
                "label" => "",
                "data" => [$validated, $notValidated],
                'backgroundColor' => $colors->backgroundColor,
                'borderColor' => $colors->borderColor,
                'borderWidth' => $colors->borderWidth,
            ]
        ];
        return compact('labels', 'datasets');
    }



    /**
     * Fetch dres classification by achievement rate
     *
     * @return array
     */
    public function achievementRate(): array
    {
        $columns = ['m.id', 'm.reference', DB::raw("CONCAT(d.code, ' - ', d.name) as dre"), DB::raw("CONCAT(a.code, ' - ', a.name) as agency"), 'm.control_campaign_id'];

        $missions = DB::table('missions as m')
            ->select($columns)
            ->join('agencies as a', 'a.id', 'm.agency_id')
            ->join('dres as d', 'd.id', 'a.dre_id');

        if (request()->has('onlyCurrentCampaign') && !request()->has('campaign')) {
            $currentCampaign = $this->current_campaign;
            if ($currentCampaign) {
                $missions = $missions->where('m.control_campaign_id', $currentCampaign?->id);
            }
        }
        if (request()->has('campaign') && !request()->has('onlyCurrentCampaign')) {
            $campaign = request('campaign');
            $missions = $missions->where('m.control_campaign_id', $campaign);
        }

        $missions = $missions->get()->groupBy('dre');

        $achievments = [];
        foreach ($missions as $dre => $missions) {
            $dreMissions = DB::table('dres as d')
                ->select(DB::raw("CONCAT(d.code, ' - ', d.name) as dre_name"), DB::raw("CONCAT(a.code, ' - ', a.name) as agency_name"), 'm.reference')
                ->leftJoin('agencies as a', 'a.dre_id', 'd.id')
                ->join('missions as m', 'm.agency_id', 'a.id')
                ->where(DB::raw("CONCAT(d.code, ' - ', d.name)"), $dre)
                ->whereIn('m.id', $missions->pluck('id'));
            $totalAchieved = (clone $dreMissions)->whereNotNull('m.cdc_validation_by_id')->count();
            $total = (clone $dreMissions)->count();
            $rate = $total ? number_format(($totalAchieved * 100) / $total, 2) : 0;
            array_push($achievments, ['dre' => $dre, 'total' => $total, 'totalAchieved' => $totalAchieved, 'rate' => $rate]);
        }
        usort($achievments, function ($a, $b) {
            if ($a['rate'] != $b['rate']) {
                return $b['rate'] <=> $a['rate']; // Tri par rapport à rate
            } elseif ($a['totalAchieved'] != $b['totalAchieved']) {
                return $b['totalAchieved'] <=> $a['totalAchieved']; // Si rate est le même, tri par rapport à totalAchieved
            } else {
                return $b['total'] <=> $a['total']; // Si rate et totalAchieved sont les mêmes, tri par rapport à total
            }
        });

        return $achievments;
    }
}
