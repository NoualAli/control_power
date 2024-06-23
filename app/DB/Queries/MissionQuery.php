<?php

namespace App\DB\Queries;

use Illuminate\Support\Facades\DB;

class MissionQuery extends BaseQuery
{
    /**
     * Prepare request
     *
     * @return App\DB\Repositories\MissionQuery
     */
    public function prepare(array $config = []): MissionQuery
    {
        extract($config);

        $this->setColumns();
        $this->setRelationships();
        $this->setFilters();
        $this->setGroups();

        if (isset($sort)) {
            $this->sort($sort);
        }
        if (isset($search)) {
            $this->search($search);
        }
        return $this;
    }

    /**
     * Set different relationships used by query
     *
     * @return void
     */
    protected function setRelationships(): void
    {
        $this->query->leftJoin('control_campaigns as cc', 'cc.id', 'm.control_campaign_id')
            ->join('agencies as a', 'a.id', 'm.agency_id')
            ->join('dres as d', 'd.id', 'a.dre_id')
            ->leftJoin('mission_details as md', 'md.mission_id', 'm.id')
            ->leftJoin('users as ci', 'ci.id', 'm.ci_validation_by_id')
            ->leftJoin('users as dci', 'dci.id', 'm.assigned_to_ci_id')
            ->leftJoin('users as dcc', 'dcc.id', 'm.assigned_to_cc_id')
            ->leftJoin('users as ucc', 'ucc.id', 'm.cc_validation_by_id')
            ->leftJoin('users as cder', 'cder.id', 'm.assigned_to_cder_id');
    }

    /**
     * Set different columns to fetch
     *
     * @return void
     */
    protected function setColumns(): void
    {
        $this->query = $this->query->select([
            'm.id',
            'm.reference',
            'cc.reference as campaign',
            'm.creator_full_name',
            'm.cdc_validator_full_name',
            'm.cdcr_validator_full_name',
            'm.dcp_validator_full_name',
            'm.current_state',
            'm.created_by_id',
            'm.cc_validation_by_id',
            'm.ci_validation_by_id',
            'm.assigned_to_cc_id',
            'm.assigned_to_cder_id',
            'm.assigned_to_ci_id',
            DB::raw("CONCAT(dci.first_name, ' ', dci.last_name) AS dre_controller_full_name"),
            DB::raw("CONCAT(dcc.first_name, ' ', dcc.last_name) AS dcp_controller_full_name"),
            DB::raw("CONCAT(cder.first_name, ' ', cder.last_name) AS der_controller_full_name"),
            DB::raw("CONCAT(ci.first_name, ' ', ci.last_name) AS ci_validator_full_name"),
            DB::raw("CONCAT(ucc.first_name, ' ', ucc.last_name) AS cc_validator_full_name"),
            DB::raw("CONCAT(d.code, ' - ', d.name) as dre"),
            DB::raw("CONCAT(a.code, ' - ', a.name) as agency"),
            DB::raw('(CASE WHEN dcp_validation_by_id IS NOT NULL THEN 1 ELSE 0 END) as is_validated_by_dcp'),
            DB::raw('(CASE WHEN cdcr_validation_by_id IS NOT NULL THEN 1 ELSE 0 END) as is_validated_by_cdcr'),
            DB::raw('(CASE WHEN cdc_validation_by_id IS NOT NULL THEN 1 ELSE 0 END) as is_validated_by_cdc'),
            DB::raw('(CASE WHEN ci_validation_by_id IS NOT NULL THEN 1 ELSE 0 END) as is_validated_by_ci'),
            DB::raw('(CASE WHEN cc_validation_by_id IS NOT NULL THEN 1 ELSE 0 END) as is_validated_by_cc'),
            DB::raw('CAST(ROUND(AVG(CAST(md.score AS DECIMAL(10, 2))), 2) AS VARCHAR(10)) as avg_score'),
            DB::raw("
                    (CASE
                        WHEN COUNT(CASE WHEN md.is_disabled = 0 THEN 1 END) = 0 THEN NULL
                        ELSE CAST(SUM(CASE WHEN md.score IS NOT NULL AND md.is_disabled = 0 THEN 1 ELSE 0 END) * 100 / NULLIF(COUNT(CASE WHEN md.is_disabled = 0 THEN md.id END), 0) AS VARCHAR(10))
                    END)
                AS progress_rate
            "),
            // DB::raw(
            //     'CASE
            //         WHEN COUNT(CASE WHEN md.is_disabled = 0 THEN 1 END) = 0 THEN NULL
            //         ELSE SUM(CASE WHEN md.score IS NOT NULL THEN 1 ELSE 0 END) * 100 / NULLIF(COUNT(md.id), 0)
            //     END as progress_rate'
            // ),
            DB::raw('DATEDIFF(day, programmed_start, CAST(GETDATE() AS DATE)) as remaining_days_before_start'),
            DB::raw('DATEDIFF(day, programmed_end,CAST(GETDATE() AS DATE)) as remaining_days_before_end'),
            DB::raw("(CASE WHEN real_start IS NOT NULL THEN FORMAT(m.real_start, 'dd-MM-yyyy') ELSE FORMAT(m.programmed_start, 'dd-MM-yyyy') END) as start_date"),
            DB::raw("(CASE WHEN real_end IS NOT NULL THEN FORMAT(m.real_end, 'dd-MM-yyyy') ELSE FORMAT(m.programmed_end, 'dd-MM-yyyy') END) as end_date"),
            DB::raw('COUNT(CASE WHEN md.is_disabled = 0 THEN 1 END) as total_md'),
            DB::raw('SUM(CASE WHEN md.score IS NOT NULL AND md.is_disabled = 0 THEN 1 ELSE 0 END) as total_controlled_md'),
            DB::raw('DATEDIFF(day, CAST(programmed_start AS DATE), COALESCE(CAST(ci_validation_at AS DATE), GETDATE())) as ci_time_left'),
            DB::raw('DATEDIFF(day, COALESCE(CAST(ci_validation_at AS DATE), GETDATE()), COALESCE(CAST(cdc_validation_at AS DATE), GETDATE())) as cdc_time_left'),
            DB::raw('DATEDIFF(day, m.ci_validation_at, m.cdc_validation_at) as time_left_ci_cdc'),
            DB::raw('DATEDIFF(day, m.cdc_validation_at, m.cdcr_validation_at) as time_left_cdc_cdcr'),
            DB::raw('DATEDIFF(day, m.cdcr_validation_at, m.dcp_validation_at) as time_left_cdcr_dcp'),
            DB::raw("
            STUFF((
                SELECT ', ' + CONCAT(cia.first_name, ' ', cia.last_name)
                FROM missions AS m2
                JOIN mission_has_controllers AS mhc2 ON m2.id = mhc2.mission_id
                JOIN users AS cia ON mhc2.user_id = cia.id
                WHERE m.id = m2.id
                FOR XML PATH('')), 1, 2, '') AS assistants
            "),
            DB::raw("
            STUFF((
                SELECT ', ' + CAST(cia.id AS VARCHAR(10))
                FROM missions AS m2
                JOIN mission_has_controllers AS mhc2 ON m2.id = mhc2.mission_id
                JOIN users AS cia ON mhc2.user_id = cia.id
                WHERE m.id = m2.id
                FOR XML PATH('')), 1, 2, '') AS assistants_id
            "),
        ]);

        if (hasRole('ci')) {
            $this->query = $this->query->addSelect([
                DB::raw(
                    '(CASE
                        WHEN CAST(ISNULL(ci_validation_at, GETDATE()) AS DATE) > CAST(programmed_end AS DATE) THEN 1
                        ELSE 0
                    END) as is_late'
                ),
            ]);
        } else {
            $this->query = $this->query->addSelect([
                DB::raw(
                    '(CASE
                        WHEN CAST(ISNULL(ci_validation_at, GETDATE()) AS DATE) > CAST(programmed_end AS DATE) OR CAST(ISNULL(cdc_validation_at, GETDATE()) AS DATE) > CAST(programmed_end AS DATE) THEN 1
                        ELSE 0
                    END) as is_late'
                ),
            ]);
        }
    }

    /**
     * Set different where clause to filter data
     *
     * @return void
     */
    protected function setFilters(): void
    {
        if (hasRole('ci')) {
            $this->query = $this->query->leftJoin('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id')->where(fn ($query) => $query->where('m.assigned_to_ci_id', $this->active_user->id)->orWhere('mhc.user_id', $this->active_user->id));
        } elseif (hasRole('cdc')) {
            $this->query = $this->query->where('m.created_by_id', $this->active_user->id);
        } elseif (hasRole('cc')) {
            $this->query = $this->query->where(function ($query) {
                $query->where('m.assigned_to_cc_id', $this->active_user->id)->orWhere('md.assigned_to_cc_id', $this->active_user->id);
            });
        } elseif (hasRole('da')) {
            $this->query = $this->query->where(function ($query) {
                $query->whereIn('m.agency_id', $this->active_user->agencies->pluck('id'))->whereDate('programmed_start', '<=', today()->format('Y-m-d'));
            });
        } elseif (hasRole('dre')) {
            $this->query = $this->query->whereIn('m.agency_id', $this->active_user->agencies->pluck('id'));
        } elseif (hasRole('cder')) {
            $this->query = $this->query->where('m.assigned_to_cder_id', $this->active_user->id);
        } elseif (hasRole('ir')) {
            $this->query = $this->query->whereIn('agency_id', $this->active_user->agencies->pluck('id'));
        }
    }

    /**
     * Set different columns to group by
     * @return void
     */
    protected function setGroups(): void
    {
        $this->query = $this->query->groupBy(
            'm.id',
            'm.reference',
            'd.code',
            'd.name',
            'a.code',
            'a.name',
            'm.created_by_id',
            'm.assigned_to_cder_id',
            'm.assigned_to_ci_id',
            'dcp_validation_by_id',
            'cdcr_validation_by_id',
            'cdc_validation_by_id',
            'ci_validation_by_id',
            'cc_validation_by_id',
            'm.assigned_to_cc_id',
            'm.created_at',
            'cc.reference',
            'm.programmed_start',
            'm.real_start',
            'm.real_end',
            'm.programmed_end',
            'm.current_state',
            'm.creator_full_name',
            'm.cdc_validator_full_name',
            'm.cdcr_validator_full_name',
            'm.dcp_validator_full_name',
            'ci.first_name',
            'ci.last_name',
            'dcc.first_name',
            'dcc.last_name',
            'dci.first_name',
            'dci.last_name',
            'ucc.last_name',
            'ucc.first_name',
            'cder.first_name',
            'cder.last_name',
            'm.ci_validation_at',
            'm.cdc_validation_at',
            'm.cdcr_validation_at',
            'm.dcp_validation_at',
        );
    }
}
