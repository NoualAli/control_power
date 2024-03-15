<?php

namespace App\DB\Queries;

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
        $this->query->leftJoin('missions as m', 'm.control_campaign_id', 'c.id');

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
            'c.reference',
            'c.id',
            'c.created_by_id',
            'c.validated_by_id',
            'c.created_at',
            'c.creator_full_name',
            'c.validator_full_name',
            DB::raw('(CASE WHEN c.is_for_testing = 1 THEN \'Oui\' ELSE \'Non\' END) AS is_for_testing_str'),
            DB::raw('CONVERT(NVARCHAR(10), start_date, 105) as start_date'),
            DB::raw('CONVERT(NVARCHAR(10), end_date, 105) as end_date'),
            DB::raw('DATEDIFF(day, CAST(GETDATE() AS DATE), start_date) as remaining_days_before_start'),
            DB::raw('DATEDIFF(day, CAST(GETDATE() AS DATE), end_date) as remaining_days_before_end'),
            DB::raw('(CASE WHEN c.validated_at IS NOT NULL THEN 1 ELSE 0 END) AS is_validated'),
            'c.is_for_testing',
            DB::raw('COUNT(m.id) as total_missions'),
            DB::raw('SUM(CASE WHEN m.dcp_validation_at IS NOT NULL THEN 1 ELSE 0 END) as total_missions_validated'),
            'c.validated_at'
        ]);

        $agencies = getAgencies()->get();

        if (!hasRole(['dre', 'cdc', 'ci', 'da'])) {
            $total_agencies = $agencies->count();
            $this->query = $this->query->addSelect([
                'realisation_rate' => DB::raw('(SELECT COUNT(m.id) * 100.0 / ' . $total_agencies . ' AS realisation_rate FROM missions as m WHERE m.cdc_validation_at IS NOT NULL AND m.control_campaign_id = c.id) AS realisation_rate')
            ]);
        }

        if (hasRole(['dre', 'cdc', 'ci'])) {
            $agencies = $agencies->pluck('id')->toArray();
            $this->query = $this->query->addSelect([
                'total_missions_dre' => DB::raw('(SELECT COUNT(m.id) AS total_missions_dre FROM missions as m WHERE m.agency_id IN (' . implode(',', $agencies) . ') AND m.control_campaign_id = c.id) AS total_missions_dre'),
                'total_missions_validated_dre' => DB::raw('(SELECT COUNT(m.id) AS total_missions_validated_dre FROM missions as m WHERE m.cdc_validation_at IS NOT NULL AND m.agency_id IN (' . implode(',', $agencies) . ') AND m.control_campaign_id = c.id) AS total_missions_validated_dre'),
                'realisation_rate_dre' => DB::raw('(SELECT COUNT(DISTINCT m.agency_id) * 100.0 / ' . count($agencies) . ' AS realisation_rate_dre FROM missions as m WHERE m.cdc_validation_at IS NOT NULL AND m.control_campaign_id = c.id AND m.agency_id IN (' . implode(',', $agencies) . ')) AS realisation_rate_dre')
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
        $this->query->whereNull('c.deleted_at');


        if (!hasRole(['dcp', 'cdcr', 'root', 'admin'])) {
            $this->query->whereNotNull('validated_at');
        }

        if (hasRole('cdcr')) {
            $this->query->where(fn ($query) => $query->where('c.created_by_id', $this->active_user->id)->orWhereNotNull('validated_at'));
        }

        if (hasRole('ci')) {
            $this->query->where(fn ($query) => $query->where('m.assigned_to_ci_id', $this->active_user->id)->orWhere('mhc.user_id', $this->active_user->id));
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
            'c.id',
            'c.reference',
            'c.created_by_id',
            'c.validated_by_id',
            'c.start_date',
            'c.end_date',
            'c.validated_at',
            'c.created_at',
            'c.creator_full_name',
            'c.validator_full_name',
            'c.is_for_testing',
        );
    }
}