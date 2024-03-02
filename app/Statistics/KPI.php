<?php

namespace App\Statistics;

use Illuminate\Support\Facades\DB;

class KPI extends StatisticsData
{
    public function accomplishRate()
    {
        /**
         * Controller
         * Assignated missions
         * Missions (AG AP)
         * Missions (AG A)
         * Missions (AG B)
         * Missions (AG C)
         * Validated missions
         * Accomplish rate
         * State
         */
        $campaign = $this->getCurrentCampaign();
        $data = DB::table('missions as m');

        $data = $data->select([
            DB::raw("CONCAT(u.last_name, ' ', u.first_name) as controller_full_name"),
            'u.gender',
            DB::raw("COUNT(DISTINCT m.id) as total_missions_assigned"),
            DB::raw("COUNT(CASE WHEN m.ci_validation_at IS NOT NULL THEN 1 ELSE NULL END) as total_missions_validated"),
            DB::raw("(COUNT(CASE WHEN m.ci_validation_at IS NOT NULL THEN 1 ELSE NULL END) / COUNT(DISTINCT m.id)) * 100 as accomplish_rate"),
            DB::raw("SUM(CASE WHEN c.name = 'AP' THEN 1 ELSE 0 END) as total_missions_assigned_ag_ap"),
            DB::raw("SUM(CASE WHEN m.ci_validation_at IS NOT NULL AND c.name = 'AP' THEN 1 ELSE 0 END) as total_missions_validated_ag_ap"),
            DB::raw("SUM(CASE WHEN c.name = 'A' THEN 1 ELSE 0 END) as total_missions_assigned_ag_a"),
            DB::raw("SUM(CASE WHEN m.ci_validation_at IS NOT NULL AND c.name = 'A' THEN 1 ELSE 0 END) as total_missions_validated_ag_a"),
            DB::raw("SUM(CASE WHEN c.name = 'B' THEN 1 ELSE 0 END) as total_missions_assigned_ag_b"),
            DB::raw("SUM(CASE WHEN m.ci_validation_at IS NOT NULL AND c.name = 'B' THEN 1 ELSE 0 END) as total_missions_validated_ag_b"),
            DB::raw("SUM(CASE WHEN c.name = 'C' THEN 1 ELSE 0 END) as total_missions_assigned_ag_c"),
            DB::raw("SUM(CASE WHEN m.ci_validation_at IS NOT NULL AND c.name = 'C' THEN 1 ELSE 0 END) as total_missions_validated_ag_c"),
        ]);

        $data = $data->leftJoin('users as u', function ($join) {
            $join->on('u.id', '=', 'm.assigned_to_ci_id');
            // $join->orOn('u.id', '=', 'mhc.user_id');
        })
            ->leftJoin('agencies as a', 'a.id', 'm.agency_id')
            ->leftJoin('categories as c', 'c.id', 'a.category_id')
            ->leftJoin('control_campaigns as cc', 'cc.id', 'm.control_campaign_id');

        $data = $data->where('u.active_role_id', 6)->where('cc.id', $campaign->id);

        if (hasRole(['cdc', 'dre'])) {
            $user = auth()->user();
            $userAgencies = $user->agencies_arr;
            $data = $data->whereIn('m.agency_id', $userAgencies);
        }

        $data = $data->groupBy([
            'u.first_name',
            'u.last_name',
            'u.gender',
        ]);

        $data = $data->orderByRaw("(COUNT(CASE WHEN m.ci_validation_at IS NOT NULL THEN 1 ELSE NULL END) / COUNT(DISTINCT m.id)) * 100 DESC") // accomplish_rate
            ->orderByRaw("COUNT(DISTINCT m.id) DESC") // total_missions_assigned
            ->orderByRaw("COUNT(CASE WHEN m.ci_validation_at IS NOT NULL THEN 1 ELSE NULL END) DESC"); // total_missions_validated

        $data = $data->get();
        return $data;
    }

    public function timeLag()
    {
        /**
         * Controller
         * Assignated missions
         * Missions (AG AP)
         * Missions (AG A)
         * Missions (AG B)
         * Missions (AG C)
         * Validated missions (late)
         * TimeLag
         * State
         */
        $campaign = $this->getCurrentCampaign();
        $data = DB::table('missions as m');
        $afterTheDeadLine = "SUM'(CASE
                                    WHEN CAST(ISNULL(ci_validation_at, GETDATE()) AS DATE) > CAST(programmed_end AS DATE) THEN 1
                                    ELSE 0
                            END)";
        $data = $data->select([
            DB::raw("CONCAT(u.last_name, ' ', u.first_name) as controller_full_name"),
            'u.gender',
            DB::raw("COUNT(DISTINCT m.id) as total_missions_assigned"),
            DB::raw("SUM(CASE WHEN c.name = 'AP' THEN 1 ELSE 0 END) as total_missions_assigned_ag_ap"),
            DB::raw("SUM(
                        CASE
                            WHEN c.name = 'AP' AND m.ci_validation_at IS NOT NULL
                                AND COALESCE(CAST(m.ci_validation_at AS DATE), GETDATE()) > CAST(m.programmed_end AS DATE)
                            THEN 1
                            ELSE 0
                        END
                    ) as total_missions_validated_ag_ap
                "),
            DB::raw("SUM(CASE WHEN c.name = 'A' THEN 1 ELSE 0 END) as total_missions_assigned_ag_a"),
            DB::raw("SUM(
                        CASE
                            WHEN c.name = 'A' AND m.ci_validation_at IS NOT NULL
                                AND COALESCE(CAST(m.ci_validation_at AS DATE), GETDATE()) > CAST(m.programmed_end AS DATE)
                            THEN 1
                            ELSE 0
                        END
                    ) as total_missions_validated_ag_a
                "),
            DB::raw("SUM(CASE WHEN c.name = 'B' THEN 1 ELSE 0 END) as total_missions_assigned_ag_b"),
            DB::raw("SUM(
                        CASE
                            WHEN c.name = 'B' AND m.ci_validation_at IS NOT NULL
                                AND COALESCE(CAST(m.ci_validation_at AS DATE), GETDATE()) > CAST(m.programmed_end AS DATE)
                            THEN 1
                            ELSE 0
                        END
                    ) as total_missions_validated_ag_b
                "),
            DB::raw("SUM(CASE WHEN c.name = 'C' THEN 1 ELSE 0 END) as total_missions_assigned_ag_c"),
            DB::raw("SUM(
                        CASE
                            WHEN c.name = 'C' AND m.ci_validation_at IS NOT NULL
                                AND COALESCE(CAST(m.ci_validation_at AS DATE), GETDATE()) > CAST(m.programmed_end AS DATE)
                            THEN 1
                            ELSE 0
                        END
                    ) as total_missions_validated_ag_c
                "),
            DB::raw($afterTheDeadLine . ' as missions_after_the_deadline'),
            DB::raw("COUNT(CASE WHEN m.ci_validation_at IS NOT NULL THEN 1 ELSE NULL END) as total_missions_validated"),
        ]);

        $data = $data->leftJoin('users as u', function ($join) {
            $join->on('u.id', '=', 'm.assigned_to_ci_id');
        })
            ->leftJoin('agencies as a', 'a.id', 'm.agency_id')
            ->leftJoin('categories as c', 'c.id', 'a.category_id')
            ->leftJoin('control_campaigns as cc', 'cc.id', 'm.control_campaign_id');

        $data = $data->where('u.active_role_id', 6)->where('cc.id', $campaign->id);
        if (hasRole(['cdc', 'dre'])) {
            $user = auth()->user();
            $userAgencies = $user->agencies_arr;
            $data = $data->whereIn('m.agency_id', $userAgencies);
        }

        $data = $data->groupBy([
            'u.first_name',
            'u.last_name',
            'u.gender',
        ]);

        $data = $data
            ->orderByRaw($afterTheDeadLine . ' DESC') // missions_after_the_deadline
            ->orderByRaw("COUNT(DISTINCT m.id) ASC") // total_missions_assigned
            ->orderByRaw("COUNT(CASE WHEN m.ci_validation_at IS NOT NULL THEN 1 ELSE NULL END) DESC"); // total_missions_validated


        $data = $data->get();
        $data = $data->map(function ($item) {
            $item->time_lag = $item->missions_after_the_deadline > 0 ? ($item->missions_after_the_deadline / $item->total_missions_validated) * 100 : 0;
            return $item;
        });
        return $data;
    }

    public function missionsFall()
    {
        /**
         * Controller
         * Assignated missions
         * Missions (AG AP)
         * Missions (AG A)
         * Missions (AG B)
         * Missions (AG C)
         * Validated missions
         * Accomplish rate
         * State
         */
        $campaign = $this->getCurrentCampaign();
        $user = auth()->user();
        $data = DB::table('missions as m');

        $data = $data->select([
            DB::raw("CONCAT(u.last_name, ' ', u.first_name) as controller_full_name"),
            'u.gender',
            DB::raw("COUNT(DISTINCT m.id) as total_missions_assigned"),
            DB::raw("COUNT(DISTINCT CASE WHEN m.ci_validation_at IS NULL THEN 1 ELSE NULL END) as total_missions_not_validated"),
            DB::raw("(COUNT(DISTINCT CASE WHEN m.ci_validation_at IS NULL THEN 1 ELSE NULL END) / COUNT(DISTINCT m.id)) * 100 as missions_fall"),
            DB::raw("SUM(CASE WHEN c.name = 'AP' THEN 1 ELSE 0 END) as total_missions_assigned_ag_ap"),
            DB::raw("SUM(CASE WHEN m.ci_validation_at IS NULL AND c.name = 'AP' THEN 1 ELSE 0 END) as total_missions_not_validated_ag_ap"),
            DB::raw("SUM(CASE WHEN c.name = 'A' THEN 1 ELSE 0 END) as total_missions_assigned_ag_a"),
            DB::raw("SUM(CASE WHEN m.ci_validation_at IS NULL AND c.name = 'A' THEN 1 ELSE 0 END) as total_missions_not_validated_ag_a"),
            DB::raw("SUM(CASE WHEN c.name = 'B' THEN 1 ELSE 0 END) as total_missions_assigned_ag_b"),
            DB::raw("SUM(CASE WHEN m.ci_validation_at IS NULL AND c.name = 'B' THEN 1 ELSE 0 END) as total_missions_not_validated_ag_b"),
            DB::raw("SUM(CASE WHEN c.name = 'C' THEN 1 ELSE 0 END) as total_missions_assigned_ag_c"),
            DB::raw("SUM(CASE WHEN m.ci_validation_at IS NULL AND c.name = 'C' THEN 1 ELSE 0 END) as total_missions_not_validated_ag_c"),
        ]);

        $data = $data->leftJoin('users as u', function ($join) {
            $join->on('u.id', '=', 'm.assigned_to_ci_id');
            // $join->orOn('u.id', '=', 'mhc.user_id');
        })
            ->leftJoin('agencies as a', 'a.id', 'm.agency_id')
            ->leftJoin('categories as c', 'c.id', 'a.category_id')
            ->leftJoin('control_campaigns as cc', 'cc.id', 'm.control_campaign_id');
        if (hasRole(['cdc', 'dre'])) {
            $userAgencies = $user->agencies_arr;
            $data = $data->whereIn('m.agency_id', $userAgencies);
        }

        $data = $data->where('u.active_role_id', 6)->where('cc.id', $campaign->id);

        $data = $data->groupBy([
            'u.first_name',
            'u.last_name',
            'u.gender',
        ]);
        $data = $data->orderByRaw("(COUNT(CASE WHEN m.ci_validation_at IS NULL THEN 1 ELSE NULL END) / COUNT(DISTINCT m.id)) * 100 DESC") // accomplish_rate
            ->orderByRaw("COUNT(DISTINCT m.id) DESC") // total_missions_assigned
            ->orderByRaw("COUNT(CASE WHEN m.ci_validation_at IS NULL THEN 1 ELSE NULL END) DESC"); // total_missions_not_validated

        $data = $data->get();
        return $data;
    }
}
