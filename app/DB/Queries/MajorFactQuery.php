<?php

namespace App\DB\Queries;

use Illuminate\Support\Facades\DB;

class MajorFactQuery extends BaseQuery
{

    /**
     * Prepare request
     *
     * @param array $config
     *
     * @return App\DB\Queries\MajorFactQuery
     */
    public function prepare(array $config = []): MajorFactQuery
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
        $this->query->leftJoin('mission_detail_regularizations AS mdr', 'mdr.mission_detail_id', 'md.id')
            ->join('missions as m', 'm.id', 'md.mission_id')
            ->join('control_campaigns as cc', 'cc.id', 'm.control_campaign_id')
            ->join('agencies as a', 'a.id', 'm.agency_id')
            ->join('dres as d', 'd.id', 'a.dre_id')
            ->join('control_points as cp', 'cp.id', 'md.control_point_id')
            ->join('processes as p', 'p.id', 'cp.process_id')
            ->join('domains as dm', 'dm.id', 'p.domain_id')
            ->join('families as f', 'f.id', 'dm.family_id');
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
            DB::raw('CONVERT(NVARCHAR(10), major_fact_is_dispatched_at, 105) as major_fact_is_dispatched_at'),
            DB::raw('(CASE WHEN major_fact_is_dispatched_at IS NOT NULL THEN 1 ELSE 0 END) as major_fact_is_dispatched_by_dcp'),
            DB::raw('(CASE WHEN major_fact_is_dispatched_to_dcp_at IS NOT NULL THEN 1 ELSE 0 END) as major_fact_is_dispatched_to_dcp'),
            'md.major_fact_is_rejected_at_dcp',
            'md.major_fact_is_rejected_at_dre',
            'md.controlled_by_ci_at',
            'md.controlled_by_cdc_at',
            'md.controlled_by_cc_at',
            'md.controlled_by_cdcr_at',
            'md.controlled_by_dcp_at',
            'md.reg_is_regularized',
            'md.reg_is_rejected',
            'md.reg_is_sanitation_in_progress',
            DB::raw('COUNT(mdr.id) AS total_regularizations')
        ]);
    }

    /**
     * Set different where clause to filter data
     *
     * @return void
     */
    protected function setFilters(): void
    {
        $this->query->whereNotNull('md.score');
        if (hasRole('ci')) {
            $this->query->join('mission_has_controllers as mhc', 'mhc.mission_id', 'md.mission_id')->whereIn('agency_id', $this->active_user->agencies_arr)->where(function ($query) {
                $query->where('major_fact', true)->orWhereNotNull('md.major_fact_is_detected_at');
            })
                ->where(fn ($query) => $query->where('m.assigned_to_ci_id', $this->active_user->id)->orWhere('mhc.user_id', $this->active_user->id)->orWhere('controlled_by_ci_id', $this->active_user->id));
        } elseif (hasRole('cdc')) {
            $this->query->whereIn('agency_id', $this->active_user->agencies_arr)->where(function ($query) {
                $query->where('md.major_fact', true)->orWhereNotNull('md.major_fact_is_detected_at');
            });
        } elseif (hasRole('dre')) {
            $this->query->whereIn('agency_id', $this->active_user->agencies_arr)
                ->whereNotNull('md.major_fact_is_dispatched_at');
        } elseif (hasRole('da')) {
            $this->query->whereIn('agency_id', $this->active_user->agencies_arr)->whereNotNull('md.major_fact_is_dispatched_at')->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole(['dcp', 'cdcr'])) {
            $this->query->where(function ($query) {
                $query->whereNotNull('md.major_fact_is_dispatched_to_dcp_at')
                    ->WhereNotNull('md.major_fact_is_detected_at');
            });
        } elseif (hasRole(['root', 'admin'])) {
            $this->query->whereNotNull('md.major_fact_is_detected_at');
        } elseif (hasRole('cder')) {
            $this->query->whereNotNull('md.major_fact_is_dispatched_at')->where('m.assigned_to_cder_id', $this->active_user->id);
        } elseif (hasRole('ir')) {
            $this->query->whereNotNull('md.major_fact_is_dispatched_at')->whereIn('m.agency_id', $this->active_user->agencies->pluck('id')->toArray());
        } else {
            $this->query->whereNotNull('md.major_fact_is_dispatched_at');
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
            'md.id',
            'md.reference',
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
            'md.created_at',
            'md.id',
            'd.id',
            'a.id',
            'md.major_fact',
            'md.major_fact_is_dispatched_at',
            'md.major_fact_is_dispatched_to_dcp_at',
            'md.major_fact_is_rejected_at_dcp',
            'md.major_fact_is_rejected_at_dre',
            'md.major_fact_is_detected_at',
            'md.controlled_by_ci_at',
            'md.controlled_by_cdc_at',
            'md.controlled_by_cc_at',
            'md.controlled_by_cdcr_at',
            'md.controlled_by_dcp_at',
            'md.reg_is_regularized',
            'md.reg_is_rejected',
            'md.reg_is_sanitation_in_progress',
        );
    }
}
