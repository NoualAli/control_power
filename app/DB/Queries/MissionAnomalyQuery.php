<?php

namespace App\DB\Queries;

use App\Models\Mission;
use Illuminate\Support\Facades\DB;

class MissionAnomalyQuery extends BaseQuery
{

    private $mission;

    /**
     * Load mission processes
     *
     * @param Mission|string $mission
     *
     * @return void
     */
    public function __construct(Mission|string $mission = null)
    {
        parent::__construct('mission_details', 'md');
        if ($mission) {
            $this->mission = is_string($mission) ? Mission::findOrFail($mission) : $mission;
        }
    }

    /**
     * Prepare request
     *
     * @param array $config
     *
     * @return App\DB\Queries\MissionAnomalyQuery
     */
    public function prepare(array $config = []): MissionAnomalyQuery
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
            ->orderBy('dm.display_priority', 'ASC')->orderBy('dm.updated_at', 'DESC')
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
            'md.score',
            DB::raw("(CASE WHEN md.controlled_by_ci_at IS NOT NULL THEN 1 ELSE 0 END) as controlled_by_ci_at"),
            DB::raw("(CASE WHEN md.controlled_by_cdc_at IS NOT NULL THEN 1 ELSE 0 END) as controlled_by_cdc_at"),
            DB::raw("(CASE WHEN md.controlled_by_cc_at IS NOT NULL THEN 1 ELSE 0 END) as controlled_by_cc_at"),
            DB::raw("(CASE WHEN md.controlled_by_cdcr_at IS NOT NULL THEN 1 ELSE 0 END) as controlled_by_cdcr_at"),
            DB::raw("(CASE WHEN md.controlled_by_dcp_at IS NOT NULL THEN 1 ELSE 0 END) as controlled_by_dcp_at"),
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
        $this->query->whereIn('score', [2, 3, 4]);
        if (!hasRole('da')) {
            $this->query->where('major_fact', false);
        }

        if ($this->mission) {
            $this->query->where('m.id', $this->mission->id);
        }

        if (hasRole('ci')) {
            $this->query->leftJoin('mission_has_controllers as mhc', 'mhc.mission_id', 'm.id')
                ->where(fn ($query) => $query
                    ->where('m.assigned_to_ci_id', $this->active_user->id)
                    ->orWhere('mhc.user_id', $this->active_user->id)
                    ->orWhere('md.assigned_to_ci_id', $this->active_user->id)
                    ->orWhere('md.controlled_by_ci_id', $this->active_user->id)
                    ->orWhere('md.assigned_to_ci_id', $this->active_user->id));
        } elseif (hasRole('cdc')) {
            $this->query->where('m.created_by_id', $this->active_user->id)->where('dre_id', getDre(auth()->user())->first()->id);
        } elseif (hasRole('cc')) {
            $this->query->where(fn ($query) => $query->where('m.assigned_to_cc_id', $this->active_user->id)->orWhere('md.assigned_to_cc_id', $this->active_user->id)->orWhere('md.controlled_by_cc_id', $this->active_user->id)->orWhere('md.assigned_to_cc_id', $this->active_user->id));
        } elseif (hasRole('da')) {
            $this->query->whereIn('m.agency_id', $this->active_user->agencies->pluck('id')->toArray())->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole('dre')) {
            $this->query->whereIn('m.agency_id', $this->active_user->agencies->pluck('id'))->whereNotNull('m.dcp_validation_by_id');
        } elseif (hasRole('cdcr')) {
            $this->query->whereNotNull('m.cdc_validation_by_id');
        } elseif (hasRole('cc')) {
            $this->query->whereNotNull('m.assigned_to_cc_id', $this->active_user->id)->whereNotNull('m.cdc_validation_by_id');
        } elseif (hasRole('dcp')) {
            $this->query->whereNotNull('m.cdcr_validation_by_id');
        } elseif (hasRole('cder')) {
            $this->query->whereNotNull('m.cdcr_validation_by_id')->where('m.assigned_to_cder_id', $this->active_user->id);
        } elseif (hasRole('ir')) {
            $this->query->whereNotNull('m.dcp_validation_by_id')->whereIn('m.agency_id', $this->active_user->agencies->pluck('id')->toArray());
        } else {
            $this->query->whereNotNull('m.dcp_validation_by_id');
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
            'md.controlled_by_ci_at',
            'md.controlled_by_cdc_at',
            'md.controlled_by_cc_at',
            'md.controlled_by_cdcr_at',
            'md.controlled_by_dcp_at',
            'md.reg_is_regularized',
            'md.reg_is_rejected',
            'md.reg_is_sanitation_in_progress',
            'cp.display_priority',
            'cp.updated_at',
            'p.display_priority',
            'p.updated_at',
            'dm.display_priority',
            'dm.updated_at',
            'f.display_priority',
            'f.updated_at'
        );
    }
}
