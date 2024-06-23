<?php

namespace App\DB\Queries;

use Exception;
use Illuminate\Support\Facades\DB;

class ControlCampaignQuery extends BaseQuery
{

    /**
     * Prepare request
     *
     * @param array $config
     *
     * @return App\DB\Queries\ControlCampaignQuery
     */
    public function prepare(array $config = []): ControlCampaignQuery
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
        $this->query->leftJoin('missions as m', 'm.control_campaign_id', 'cc.id');

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
            'cc.reference',
            'cc.id',
            'cc.created_by_id',
            'cc.validated_by_id',
            'cc.created_at',
            'cc.creator_full_name',
            'cc.validator_full_name',
            DB::raw('(CASE WHEN cc.is_for_testing = 1 THEN \'Oui\' ELSE \'Non\' END) AS is_for_testing_str'),
            DB::raw('CONVERT(NVARCHAR(10), start_date, 105) as start_date'),
            DB::raw('CONVERT(NVARCHAR(10), end_date, 105) as end_date'),
            DB::raw('DATEDIFF(day, CAST(GETDATE() AS DATE), start_date) as remaining_days_before_start'),
            DB::raw('DATEDIFF(day, CAST(GETDATE() AS DATE), end_date) as remaining_days_before_end'),
            DB::raw('(CASE WHEN cc.validated_at IS NOT NULL THEN 1 ELSE 0 END) AS is_validated'),
            DB::raw('SUM(CASE WHEN m.dcp_validation_at IS NOT NULL THEN 1 ELSE 0 END) as total_missions_validated'),
            'cc.is_for_testing',
            DB::raw('COUNT(m.id) as total_missions'),
            'cc.validated_at',
        ]);

        $agencies = getAgencies()->get();

        if (!hasRole(['dre', 'cdc', 'ci', 'da', 'ir'])) {
            $total_agencies = $agencies->count();
            $this->query = $this->query->addSelect([
                'realisation_rate' => DB::raw('(SELECT COUNT(m.id) * 100.0 / ' . $total_agencies . ' AS realisation_rate FROM missions as m WHERE m.cdc_validation_at IS NOT NULL AND m.control_campaign_id = cc.id) AS realisation_rate'),
                'total_missions_validated_dre' => DB::raw('SUM(CASE WHEN m.cdc_validation_at IS NOT NULL THEN 1 ELSE 0 END) as total_missions_validated_dre'),
            ]);
        }

        if (hasRole(['dre', 'cdc', 'ci', 'ir'])) {
            $agencyIds = implode(',', $agencies->pluck('id')->toArray());
            $total_agencies = $agencies->count();
            $this->query = $this->query->addSelect([
                'total_missions_dre' => DB::raw('(SELECT COUNT(m.id) AS total_missions_dre FROM missions as m WHERE m.agency_id IN (' . $agencyIds . ') AND m.control_campaign_id = cc.id) AS total_missions_dre'),
                'total_missions_validated_dre' => DB::raw('(SELECT COUNT(m.id) AS total_missions_validated_dre FROM missions as m WHERE m.cdc_validation_at IS NOT NULL AND m.agency_id IN (' . $agencyIds . ') AND m.control_campaign_id = cc.id) AS total_missions_validated_dre'),
                'realisation_rate_dre' => DB::raw('(SELECT COUNT(DISTINCT m.agency_id) * 100.0 / ' . $total_agencies . ' AS realisation_rate_dre FROM missions as m WHERE m.cdc_validation_at IS NOT NULL AND m.control_campaign_id = cc.id AND m.agency_id IN (' . $agencyIds . ')) AS realisation_rate_dre')
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
        if (!hasRole(['dcp', 'cdcr', 'root', 'admin'])) {
            $this->query->whereNotNull('validated_at');
        }

        if (hasRole('cdcr')) {
            $this->query->where(fn ($query) => $query->where('cc.created_by_id', $this->active_user->id)->orWhereNotNull('validated_at'));
        }

        if (hasRole('ci')) {
            $this->query->where(fn ($query) => $query->where('m.assigned_to_ci_id', $this->active_user->id)->orWhere('mhc.user_id', $this->active_user->id));
        }

        if (hasRole('cc')) {
            $this->query->where(fn ($query) => $query->where('m.assigned_to_cc_id', $this->active_user->id));
        }

        if (hasRole('cder')) {
            $this->query->where('m.assigned_to_cder_id', $this->active_user->id);
        }
    }

    /**
     * Set different columns to group by
     *
     * @return void
     */
    protected function setGroups(): void
    {
        $this->query->groupBy(
            'cc.id',
            'cc.reference',
            'cc.created_by_id',
            'cc.validated_by_id',
            'cc.start_date',
            'cc.end_date',
            'cc.validated_at',
            'cc.created_at',
            'cc.creator_full_name',
            'cc.validator_full_name',
            'cc.is_for_testing',
        );
    }
}
