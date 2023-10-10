<?php

use App\Models\User;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

if (!function_exists('getMissions')) {
    /**
     * Fetch Missions
     *
     * @return Builder
     */
    function getMissions()
    {
        $columns = ['m.id', 'm.reference', DB::raw('CONCAT(d.code, " - ", d.name) as dre'), DB::raw('CONCAT(a.code, " - ", a.name) as agency')];
        if (env('DB_CONNECTION') == 'sqlsrv') {
            $columns = [
                'm.id',
                'm.reference',
                'cc.reference as campaign',
                DB::raw("CONCAT(d.code, ' - ', d.name) as dre"),
                DB::raw("CONCAT(a.code, ' - ', a.name) as agency"),
                DB::raw('(CASE WHEN dcp_validation_by_id IS NOT NULL THEN 1 ELSE 0 END) as is_validated_by_dcp'),
                DB::raw('(CASE WHEN cdcr_validation_by_id IS NOT NULL THEN 1 ELSE 0 END) as is_validated_by_cdcr'),
                DB::raw('(CASE WHEN cdc_validation_by_id IS NOT NULL THEN 1 ELSE 0 END) as is_validated_by_cdc'),
                DB::raw('(CASE WHEN ci_validation_by_id IS NOT NULL THEN 1 ELSE 0 END) as is_validated_by_ci'),
                DB::raw('(CASE WHEN cc_validation_by_id IS NOT NULL THEN 1 ELSE 0 END) as is_validated_by_cc'),
                DB::raw('CAST(ROUND(AVG(CAST(md.score AS DECIMAL(10, 2))), 2) AS VARCHAR(10)) as avg_score'),
                DB::raw('DATEDIFF(day, programmed_start, CAST(GETDATE() AS DATE)) as remaining_days_before_start'),
                DB::raw('DATEDIFF(day, CAST(GETDATE() AS DATE), programmed_end) as remaining_days_before_end'),
                DB::raw('(CASE WHEN reel_start IS NOT NULL THEN m.reel_start ELSE m.programmed_start END) as start_date'),
                DB::raw('(CASE WHEN reel_end IS NOT NULL THEN m.reel_end ELSE m.programmed_end END) as end_date'),
                DB::raw('COUNT(md.id) as total_md'),
                // DB::raw('COUNT(md2.id) as total_scored_md')
                // DB::raw("(SELECT STRING_AGG(ISNULL(u.username, ''), ', ') WITHIN GROUP (ORDER BY u.username)) AS dre_controllers")
            ];
        }
        $columns = [
            'm.id',
            'm.reference',
            'cc.reference as campaign',
            DB::raw("CONCAT(d.code, ' - ', d.name) as dre"),
            DB::raw("CONCAT(a.code, ' - ', a.name) as agency"),
            DB::raw('(CASE WHEN dcp_validation_by_id IS NOT NULL THEN 1 ELSE 0 END) as is_validated_by_dcp'),
            DB::raw('(CASE WHEN cdcr_validation_by_id IS NOT NULL THEN 1 ELSE 0 END) as is_validated_by_cdcr'),
            DB::raw('(CASE WHEN cdc_validation_by_id IS NOT NULL THEN 1 ELSE 0 END) as is_validated_by_cdc'),
            DB::raw('(CASE WHEN ci_validation_by_id IS NOT NULL THEN 1 ELSE 0 END) as is_validated_by_ci'),
            DB::raw('(CASE WHEN cc_validation_by_id IS NOT NULL THEN 1 ELSE 0 END) as is_validated_by_cc'),
            DB::raw('CAST(ROUND(AVG(CAST(md.score AS DECIMAL(10, 2))), 2) AS VARCHAR(10)) as avg_score'),
            DB::raw('DATEDIFF(day, programmed_start, CAST(GETDATE() AS DATE)) as remaining_days_before_start'),
            DB::raw('DATEDIFF(day, CAST(GETDATE() AS DATE), programmed_end) as remaining_days_before_end'),
            DB::raw('(CASE WHEN reel_start IS NOT NULL THEN m.reel_start ELSE m.programmed_start END) as start_date'),
            DB::raw('(CASE WHEN reel_end IS NOT NULL THEN m.reel_end ELSE m.programmed_end END) as end_date'),
            DB::raw('COUNT(md.id) as total_md'),
            DB::raw('SUM(CASE WHEN md.score IS NOT NULL THEN 1 ELSE 0 END) as total_controlled_md'),
            DB::raw('SUM(CASE WHEN md.score IS NOT NULL THEN 1 ELSE 0 END)  * 100 / COUNT(md.id) progress_rate'),
            'm.current_state'
            // DB::raw('(CASE WHEN SUM(CASE WHEN md.score IS NOT NULL THEN 1 ELSE 0 END) > 0 THEN (SUM(CASE WHEN md.score IS NOT NULL THEN 1 ELSE 0 END) * 100) / COUNT(md.id) ELSE 0 END) as progress_rate')
        ];

        $missions = DB::table('missions as m')
            ->select($columns)
            ->leftJoin('control_campaigns as cc', 'cc.id', 'm.control_campaign_id')
            ->join('agencies as a', 'a.id', 'm.agency_id')
            ->join('dres as d', 'd.id', 'a.dre_id')
            ->join('mission_details as md', 'md.mission_id', 'm.id')
            ->join('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id');

        $user = auth()->user();

        if (hasRole('ci')) {
            $missions = $missions->where('mhc.user_id', $user->id);
        } elseif (hasRole('cdc')) {
            $missions = $missions->where('m.created_by_id', $user->id);
        } elseif (hasRole('cc')) {
            $missions = $missions->where('md.assigned_to_cc_id', $user->id);
        } elseif (hasRole('da')) {
            $missions = $missions->whereIn('m.agency_id', $user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole('dre')) {
            $missions = $missions->whereIn('m.agency_id', $user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
        }

        $missions = $missions->groupBy('m.id', 'm.reference', 'd.code', 'd.name', 'a.code', 'a.name', 'dcp_validation_by_id', 'cdcr_validation_by_id', 'cdc_validation_by_id', 'ci_validation_by_id', 'cc_validation_by_id', 'm.created_at', 'cc.reference', 'm.programmed_start', 'm.reel_start', 'm.reel_end', 'm.programmed_end', 'm.current_state');
        return $missions;
    }
}

if (!function_exists('getMissionDetails')) {
    /**
     * Fetch Mission Details
     *
     * @return Builder
     */
    function getMissionDetails(bool $majorFacts = false)
    {
        if (!$majorFacts) {
            $columns = [
                'md.id',
                'm.reference as mission',
                'cc.reference as campaign',
                DB::raw('CONCAT(d.code, " - ", d.name) as dre'),
                DB::raw('CONCAT(a.code, " - ", a.name) as agency'),
                'd.id as dre_id',
                'a.id as agency_id',
                'f.id as family_id',
                'f.name as family',
                'dm.id as domain_id',
                'dm.name as domain',
                'p.id as process_id',
                'p.name as process',
                'cp.id as control_point_id',
                'cp.name as control_point',
                'md.score',
                'md.is_regularized'
                // DB::raw("(CASE WHEN COUNT(mdr.id) > 0 THEN Levée ELSE 'Non levée' END) as is_regularized")
            ];
        } else {
            $columns = [
                'md.id',
                'm.reference as mission',
                'cc.reference as campaign',
                DB::raw('CONCAT(d.code, " - ", d.name) as dre'),
                DB::raw('CONCAT(a.code, " - ", a.name) as agency'),
                'd.id as dre_id',
                'a.id as agency_id',
                'f.id as family_id',
                'f.name as family',
                'dm.id as domain_id',
                'dm.name as domain',
                'p.id as process_id',
                'p.name as process',
                'cp.id as control_point_id',
                'cp.name as control_point',
                DB::raw('DATE_FORMAT(major_fact_dispatched_at, "%d-%m-%Y") as major_fact_dispatched_at'),
            ];
        }

        if (env('DB_CONNECTION') == 'sqlsrv') {
            if (!$majorFacts) {
                $columns = [
                    'md.id',
                    'm.reference as mission',
                    'cc.reference as campaign',
                    DB::raw("CONCAT(d.code, ' - ', d.name) as dre"),
                    DB::raw("CONCAT(a.code, ' - ', a.name) as agency"),
                    'd.id as dre_id',
                    'a.id as agency_id',
                    'f.id as family_id',
                    'f.name as family',
                    'dm.id as domain_id',
                    'dm.name as domain',
                    'p.id as process_id',
                    'p.name as process',
                    'cp.id as control_point_id',
                    'cp.name as control_point',
                    'md.score',
                    // DB::raw("(CASE WHEN COUNT(mdr.id) > 0 THEN Levée ELSE 'Non levée' END) as is_regularized")
                    'md.is_regularized'
                ];
            } else {
                $columns = [
                    'md.id',
                    'm.reference as mission',
                    'cc.reference as campaign',
                    DB::raw("CONCAT(d.code, ' - ', d.name) as dre"),
                    DB::raw("CONCAT(a.code, ' - ', a.name) as agency"),
                    'd.id as dre_id',
                    'a.id as agency_id',
                    'f.id as family_id',
                    'f.name as family',
                    'dm.id as domain_id',
                    'dm.name as domain',
                    'p.id as process_id',
                    'p.name as process',
                    'cp.id as control_point_id',
                    'cp.name as control_point',
                    DB::raw('CONVERT(NVARCHAR(10), major_fact_dispatched_at, 105) as major_fact_dispatched_at'),
                ];
            }
        }

        $details = DB::table('mission_details as md')
            ->select($columns)
            ->whereNotNull('md.score')
            ->join('missions as m', 'm.id', 'md.mission_id')
            ->join('control_campaigns as cc', 'cc.id', 'm.control_campaign_id')
            ->join('agencies as a', 'a.id', 'm.agency_id')
            ->join('dres as d', 'd.id', 'a.dre_id')
            ->join('control_points as cp', 'cp.id', 'md.control_point_id')
            ->join('processes as p', 'p.id', 'cp.process_id')
            ->join('domains as dm', 'dm.id', 'p.domain_id')
            ->join('families as f', 'f.id', 'dm.family_id');

        // if (!$majorFacts) {
        //     $details = $details->leftJoin('mission_detail_regularizations as mdr', function ($join) {
        //         $join->on('md.id', '=', 'mdr.mission_detail_id')
        //             ->where('mdr.is_regularized', '=', 1);
        //     });
        // }

        if ($majorFacts) {
            $details = $details->where('major_fact', true);
        } else {
            $details = $details->whereIn('score', [2, 3, 4])->whereNot('major_fact', true);
        }

        if (!$majorFacts) {
            $details = $details->groupBy(
                'md.id',
                'm.reference',
                'cc.reference',
                'd.code',
                'd.name',
                'a.code',
                'a.name',
                'f.name',
                'dm.name',
                'p.name',
                'cp.name',
                'f.id',
                'dm.id',
                'p.id',
                'cp.id',
                'md.score',
                'md.created_at',
                'md.id',
                'd.id',
                'a.id',
                'md.is_regularized'
            );
        } else {
            $details = $details->groupBy(
                'md.id',
                'm.reference',
                'cc.reference',
                'd.code',
                'd.name',
                'a.code',
                'a.name',
                'f.name',
                'dm.name',
                'p.name',
                'cp.name',
                'f.id',
                'dm.id',
                'p.id',
                'cp.id',
                'md.major_fact_dispatched_at',
                'md.created_at',
                'md.id',
                'd.id',
                'a.id'
            );
        }


        $user = auth()->user();
        if (hasRole('ci')) {
            $details = $details->join('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id')->where('mhc.user_id', $user->id);
        } elseif (hasRole('cdc')) {
            $details = $details->where('m.created_by_id', $user->id)->where('dre_id', getDre(auth()->user())->first()->id);
        } elseif (hasRole('cc')) {
            $details = $details->where('md.assigned_to_cc_id', $user->id);
        } elseif (hasRole('da')) {
            $details = $details->whereIn('m.agency_id', $user->agencies->pluck('id')->toArray())->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole('dre')) {
            $details = $details->whereIn('m.agency_id', $user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
        }

        if ($majorFacts) {
            $details = $details->where('has_major_fact', true);
        }
        return $details;
    }
}

if (!function_exists('getControlCampaigns')) {
    /**
     * Fetch Control Campaigns
     *
     * @param App\Models\User|null
     *
     * @return Builder
     */
    function getControlCampaigns(?User $user = null)
    {
        $columns = [
            'c.reference',
            'c.id',
            'c.created_by_id',
            'c.validated_by_id',
            'c.created_at',
            DB::raw('DATE_FORMAT(start_date, "%d-%m-%Y") as start'),
            DB::raw('DATE_FORMAT(end_date, "%d-%m-%Y") as end'),
            DB::raw('DATEDIFF(start_date, CURDATE()) as remaining_days_before_start'),
            DB::raw('DATEDIFF(end_date, CURDATE()) as remaining_days_before_end'),
            DB::raw('(CASE WHEN c.validated_at IS NOT NULL THEN 1 ELSE 0 END) AS is_validated'),
            'c.validated_at'
        ];

        if (env('DB_CONNECTION') == 'sqlsrv') {
            $columns = [
                'c.reference',
                'c.id',
                'c.created_by_id',
                'c.validated_by_id',
                'c.created_at',
                DB::raw('CONVERT(NVARCHAR(10), start_date, 105) as start_date'),
                DB::raw('CONVERT(NVARCHAR(10), end_date, 105) as end_date'),
                DB::raw('DATEDIFF(day, start_date, CAST(GETDATE() AS DATE)) as remaining_days_before_start'),
                DB::raw('DATEDIFF(day, CAST(GETDATE() AS DATE), end_date) as remaining_days_before_end'),
                DB::raw('(CASE WHEN c.validated_at IS NOT NULL THEN 1 ELSE 0 END) AS is_validated'),
                'c.validated_at'
            ];
        }

        $campaigns = DB::table('control_campaigns as c')->select($columns);

        $user = $user ?: auth()->user();
        if (hasRole('cdcr')) {
            $campaigns = $campaigns->where('created_by_id', $user->id);
        }

        if (!hasRole(['dcp', 'cdcr'])) {
            $campaigns = $campaigns->whereNotNull('validated_at');
        }

        $campaigns = $campaigns->groupBy('c.id', 'c.reference', 'c.created_by_id', 'c.validated_by_id', 'c.start_date', 'c.end_date', 'c.validated_at', 'c.created_at');
        if (!hasRole(['cdcr', 'dcp'])) {
            $campaigns = $campaigns->whereNotNull('validated_at');
        }
        return $campaigns;
    }
}

if (!function_exists('getDre')) {
    function getDre(?User $user = null)
    {
        $user = $user ?: auth()->user();
        $dre = DB::table('dres as d')->select('d.id', 'd.code', 'd.name', DB::raw("CONCAT(d.code,' - ', d.name) as full_name"));

        if (hasRole(['ci', 'cdc', 'dre', 'da'])) {
            $dre = $dre->leftJoin('agencies as a', 'd.id', 'a.dre_id')->leftJoin('user_has_agencies as uha', 'uha.agency_id', 'a.id')->where('uha.user_id', $user->id);
        }
        $dre = $dre->groupBy('d.id', 'd.code', 'd.name');
        // if ($first) {
        //     return $dre->first();
        // }
        return $dre;
        // return $dre->get();
    }
}

if (!function_exists('getAgencies')) {
    function getAgencies(?User $user = null)
    {
        $user = $user ?: auth()->user();
        $agencies = DB::table('agencies as a')->select('a.id', 'a.code', 'a.name', DB::raw("CONCAT(a.code,' - ', a.name) as full_name"), 'a.dre_id as dre');

        if (hasRole(['ci', 'cdc', 'dre', 'da'])) {
            $agencies = $agencies->leftJoin('user_has_agencies as uha', 'uha.agency_id', 'a.id')->where('uha.user_id', $user->id);
        }
        $agencies = $agencies->groupBy('a.id', 'a.code', 'a.name', 'a.dre_id');
        return $agencies;
    }
}

if (!function_exists('getFamilies')) {
    function getFamilies()
    {
        $families = DB::table('families as f')->select('f.id', 'f.name');
        return $families;
    }
}

if (!function_exists('getDomains')) {
    function getDomains()
    {
        $domains = DB::table('domains as d')->select('d.id', 'd.name');
        return $domains;
    }
}

if (!function_exists('getProcesses')) {
    function getProcesses()
    {
        $processes = DB::table('processes as p')->select('p.id', 'p.name');
        return $processes;
    }
}

if (!function_exists('search')) {
    /**
     * Search in query builder
     *
     * @param Builder $query
     * @param string|null $value
     *
     * @return Illuminate\Contracts\Database\Query\Builder
     */
    function search(Builder $query, ?string $value): Builder
    {
        $columns = $query->columns;
        $query = $query->where(function ($query) use ($columns, $value) {
            $i = 0;
            foreach ($columns as $key => $column) {
                $field = $column;
                $isAlias = false;
                // Check if the column has an alias
                if (str_contains($column, 'as')) {
                    $isAlias = true;
                    [$field, $alias] = explode(' as ', strtolower($column));
                    $field = trim($field);
                }
                if ($field !== 'password' && !str_contains($field, 'id')) {
                    if ($isAlias) {
                        $clause = 'having';
                    } else {
                        $clause = $i > 0 ? 'orWhere' : 'where';
                    }
                    $query = $query->$clause($field, 'LIKE', '%' . $value . '%');
                }
                $i += 1;
            }
            return $query;
        });
        return $query;
    }
}

if (!function_exists('orderByMultiple')) {
    /**
     * Order by multiple columns in query builder
     *
     * @param Builder $query
     * @param string|null $value
     *
     * @return Illuminate\Contracts\Database\Query\Builder
     */
    function orderByMultiple(Builder $query, ?array $data): Builder
    {
        foreach ($data as $column => $direction) {
            $query = $query->orderBy($column, $direction);
        }
        return $query;
    }
}
