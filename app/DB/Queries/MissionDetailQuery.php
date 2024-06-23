<?php

namespace App\DB\Queries;

use Illuminate\Support\Facades\DB;

class MissionDetailQuery extends BaseQuery
{

    /**
     * Prepare request
     *
     * @param array $config
     *
     * @return App\DB\Queries\MissionDetailQuery
     */
    public function prepare(array $config = []): MissionDetailQuery
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

        $this->query = $this->query->orderBy('f.display_priority', 'ASC')->orderBy('f.updated_at', 'DESC')
            ->orderBy('d.display_priority', 'ASC')->orderBy('d.updated_at', 'DESC')
            ->orderBy('p.display_priority', 'ASC')->orderBy('p.updated_at', 'DESC')
            ->orderBy('cp.display_priority', 'ASC')->orderBy('cp.updated_at', 'DESC');

        return $this;
    }

    /**
     * Set different relationships used by query
     *
     * @return void
     */
    protected function setRelationships(): void
    {
        $this->query->leftJoin('missions as m', 'm.id', 'md.mission_id')
            ->join('control_campaigns as cc', 'cc.id', 'm.control_campaign_id')
            ->join('control_points as cp', 'cp.id', 'md.control_point_id')
            ->join('processes as p', 'p.id', 'cp.process_id')
            ->join('domains as d', 'd.id', 'p.domain_id')
            ->join('families as f', 'f.id', 'd.family_id')
            ->leftJoin('users as ci', 'ci.id', 'md.controlled_by_ci_id')
            ->leftJoin('users as ccr', 'ccr.id', 'md.controlled_by_cc_id');

        if (hasRole('ci')) {
            $this->query->leftJoin('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id');
        }
    }

    /**
     * Set different columns to fetch
     *
     * @return void
     */
    protected function setColumns(): void
    {
        $this->query = $this->query->select([
            'md.id',
            'md.reference',
            'md.is_disabled',
            'm.reference as mission',
            'm.id as mission_id',
            'm.cc_validation_by_id',
            'm.cdcr_validation_by_id',
            'm.dcp_validation_by_id',
            'cc.reference as campaign',
            'cc.id as campaign_id',
            'f.id as family_id',
            'f.name as family',
            'd.id as domain_id',
            'd.name as domain',
            'p.id as process_id',
            'p.name as process',
            'cp.id as control_point_id',
            'cp.name as control_point',
            'md.score',
            'md.recovery_plan',
            DB::raw("(CASE WHEN md.controlled_by_ci_at IS NOT NULL THEN 1 ELSE 0 END) as is_controlled_by_ci"),
            DB::raw("(CASE WHEN md.controlled_by_cdc_at IS NOT NULL THEN 1 ELSE 0 END) as is_controlled_by_cdc"),
            DB::raw("(CASE WHEN md.controlled_by_cc_at IS NOT NULL THEN 1 ELSE 0 END) as is_controlled_by_cc"),
            DB::raw("(CASE WHEN md.controlled_by_cdcr_at IS NOT NULL THEN 1 ELSE 0 END) as is_controlled_by_cdcr"),
            DB::raw("(CASE WHEN md.controlled_by_dcp_at IS NOT NULL THEN 1 ELSE 0 END) as is_controlled_by_dcp"),
            DB::raw('CONVERT(NVARCHAR(10), major_fact_is_dispatched_at, 105) as major_fact_is_dispatched_at'),
            DB::raw('(CASE WHEN major_fact_is_dispatched_at IS NOT NULL THEN 1 ELSE 0 END) as major_fact_is_dispatched_by_dcp'),
            DB::raw('(CASE WHEN major_fact_is_dispatched_to_dcp_at IS NOT NULL THEN 1 ELSE 0 END) as major_fact_is_dispatched_to_dcp'),
            DB::raw('(CASE WHEN major_fact_is_rejected_at_dcp IS NOT NULL THEN 1 ELSE 0 END) as major_fact_is_pending_at_dcp'),
            DB::raw('(CASE WHEN major_fact_is_rejected_at_dre IS NOT NULL THEN 1 ELSE 0 END) as major_fact_is_pending_at_dre'),
            'md.cdc_full_name',
            'md.cdcr_full_name',
            'md.dcp_full_name',
            DB::raw("CONCAT(ci.first_name, ' ', ci.last_name) as ci_full_name"),
            DB::raw("CONCAT(ccr.first_name, ' ', ccr.last_name) as cc_full_name"),
            'md.major_fact_is_dispatched_by_full_name',
            'md.major_fact_is_dispatched_to_dcp_by_full_name',
            'md.major_fact_is_dispatched_to_dcp_at',
            'md.major_fact_is_detected_by_full_name',
            'md.major_fact_is_detected_at',
            'md.major_fact_is_rejected_at_dcp',
            'md.major_fact_is_rejected_at_dre',
            'md.major_fact_is_rejected_at',
            'md.major_fact_is_rejected_by_full_name',
            'md.major_fact',
            'md.controlled_by_ci_at',
            'md.controlled_by_cdc_at',
            'md.controlled_by_cc_at',
            'md.controlled_by_cdcr_at',
            'md.controlled_by_dcp_at',
            'md.metadata',
            'md.reg_is_regularized',
            'md.reg_is_rejected',
            'md.reg_is_sanitation_in_progress',
        ]);
    }

    /**
     * Set different where clause to filter data
     *
     * @return void
     */
    protected function setFilters(): void
    {
        if (hasRole('ci')) {
            $this->query = $this->query->where(
                fn ($query) => $query
                    ->where('m.assigned_to_ci_id', $this->active_user->id)
                    ->orWhere('mhc.user_id', $this->active_user->id)
                    ->orWhere('md.controlled_by_ci_id', $this->active_user->id)
            );
        } elseif (hasRole('cdc')) {
            $this->query = $this->query->where('m.created_by_id', $this->active_user->id)->whereIn('m.agency_id', $this->active_user->agencies->pluck('id')->toArray());
        } elseif (hasRole('cc')) {
            $this->query = $this->query->where(fn ($query) => $query->where('m.assigned_to_cc_id', $this->active_user->id)->orWhere('md.assigned_to_cc_id', $this->active_user->id)->orWhere('md.controlled_by_ci_id', $this->active_user->id));
        } elseif (hasRole(['da', 'ir'])) {
            $this->query = $this->query->whereIn('m.agency_id', $this->active_user->agencies->pluck('id')->toArray())->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole('dre')) {
            $this->query = $this->query->whereIn('m.agency_id', $this->active_user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole(['cdcr', 'dcp'])) {
            $this->query = $this->query->whereNotNull('m.cdc_validation_by_id');
        } elseif (hasRole('cc')) {
            $this->query = $this->query->whereNotNull('m.assigned_to_cc_id', $this->active_user->id)->whereNotNull('m.cdc_validation_by_id');
        } elseif (hasRole('cder')) {
            $this->query = $this->query->whereNotNull('m.assigned_to_cder_id');
        } else {
            $this->query = $this->query->whereNotNull('m.dcp_validation_by_id');
        }
    }

    /**
     * Set different columns to group by
     *
     * @return void
     */
    protected function setGroups(): void
    {
        $this->query = $this->query->groupBy(
            'md.reference',
            'md.is_disabled',
            'md.id',
            'md.score',
            'md.created_at',
            'md.controlled_by_ci_at',
            'md.controlled_by_cdc_at',
            'md.controlled_by_cc_at',
            'md.controlled_by_cdcr_at',
            'md.controlled_by_dcp_at',
            'md.recovery_plan',
            'md.reg_is_regularized',
            'md.reg_is_rejected',
            'md.reg_is_sanitation_in_progress',
            'md.major_fact_is_dispatched_by_full_name',
            'md.major_fact_is_dispatched_to_dcp_by_full_name',
            'md.major_fact_is_dispatched_at',
            'md.major_fact_is_dispatched_to_dcp_at',
            'md.major_fact_is_detected_by_full_name',
            'md.major_fact_is_detected_at',
            'md.major_fact_is_rejected_at_dcp',
            'md.major_fact_is_rejected_at_dre',
            'md.major_fact_is_rejected_at',
            'md.major_fact_is_rejected_by_full_name',
            'md.major_fact',
            'md.cdc_full_name',
            'md.cdcr_full_name',
            'md.dcp_full_name',
            'ci.first_name',
            'ci.last_name',
            'ccr.first_name',
            'ccr.last_name',
            'md.metadata',
            'm.id',
            'm.reference',
            'm.created_by_id',
            'm.cc_validation_by_id',
            'm.cdcr_validation_by_id',
            'm.dcp_validation_by_id',
            'cc.reference',
            'cc.id',
            'f.id',
            'f.name',
            'f.display_priority',
            'f.updated_at',
            'd.id',
            'd.name',
            'd.display_priority',
            'd.updated_at',
            'p.id',
            'p.name',
            'p.display_priority',
            'p.updated_at',
            'cp.id',
            'cp.name',
            'cp.display_priority',
            'cp.updated_at',
        );
    }
}
