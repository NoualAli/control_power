<?php

namespace App\DB\Queries;

use App\Models\Mission;
use App\Models\Process;
use Illuminate\Support\Facades\DB;

class MissionProcessesQuery extends BaseQuery
{
    protected $mission;
    protected $process;

    /**
     * Load mission processes
     *
     * @param Mission|string $mission
     * @param Process|int|null $process
     *
     * @return void
     */
    public function __construct(Mission|string $mission, Process|int $process = null)
    {
        parent::__construct('processes', 'p');
        $this->mission = is_string($mission) ? Mission::findOrFail($mission) : $mission;
    }

    /**
     * Prepare request
     *
     * @return App\DB\Queries\MissionProcessesQuery|App\Models\Process
     */
    public function prepare(): MissionProcessesQuery
    {
        $this->setColumns();
        $this->setRelationships();
        $this->setFilters();
        $this->setGroups();
        $this->query
            ->orderBy('f.display_priority', 'ASC')->orderBy('f.updated_at', 'DESC')
            ->orderBy('d.display_priority', 'ASC')->orderBy('d.updated_at', 'DESC')
            ->orderBy('p.display_priority', 'ASC')->orderBy('p.updated_at', 'DESC');
        return $this;
    }

    /**
     * Set different relationships used by query
     *
     * @return void
     */
    protected function setRelationships(): void
    {
        $this->query->join('control_points as cp', 'p.id', '=', 'cp.process_id')
            ->leftJoin('domains as d', 'd.id', '=', 'p.domain_id')
            ->leftJoin('families as f', 'f.id', '=', 'd.family_id')
            ->leftJoin('mission_details as md', 'cp.id', '=', 'md.control_point_id')
            ->leftJoin('missions as m', 'm.id', '=', 'md.mission_id');
    }

    /**
     * Set different columns to fetch
     *
     * @return void
     */
    protected function setColumns(): void
    {
        $this->query->select([
            'm.id as mission_id',
            "p.id as process_id",
            "p.name as process",
            "d.name as domain",
            "f.name as family",
            "f.id as family_id",
            "d.id as domain_id",
            DB::raw("CASE WHEN COUNT(CASE WHEN md.major_fact > 0 THEN 1 ELSE NULL END) > 0 THEN 'Oui' ELSE 'Non' END AS major_fact"),
            DB::raw("COUNT(cp.id) - SUM(CASE WHEN md.is_disabled = 1 THEN 1 ELSE 0 END) as control_points_count"),
            DB::raw('(SELECT COUNT(*) FROM control_points WHERE process_id = p.id AND is_active = 1) AS activated_control_points_count'),
            DB::raw("COUNT(CASE WHEN score IN (2, 3, 4) THEN 1 ELSE NULL END) AS total_anomalies"),
            DB::raw("AVG(md.score) as avg_score"),
            DB::raw("(100 * COUNT(CASE WHEN score IN (2, 3, 4) THEN 1 ELSE NULL END)) / NULLIF(COUNT(CASE WHEN md.is_disabled = 0 THEN 1 ELSE NULL END), 0) AS anomalies_rate"),
            DB::raw("(100 * COUNT(CASE WHEN score IS NOT NULL THEN 1 ELSE NULL END)) / NULLIF(COUNT(CASE WHEN md.is_disabled = 0 THEN md.id ELSE NULL END), 0) AS progress_rate"),
        ]);
        if (hasRole('cdc')) {
            $this->query->addSelect([
                DB::raw('SUM(CASE WHEN md.controlled_by_cdc_at IS NOT NULL THEN 1 ELSE 0 END) AS total_controlled'),
                DB::raw('(100 * SUM(CASE WHEN md.controlled_by_cdc_at IS NOT NULL THEN 1 ELSE 0 END)) / NULLIF(COUNT(cp.id) - SUM(CASE WHEN md.is_disabled = 1 THEN 1 ELSE 0 END), 0) AS control_rate'),
            ]);
        } elseif (hasRole('cc')) {
            $this->query->addSelect([
                DB::raw('SUM(CASE WHEN md.controlled_by_cc_at IS NOT NULL THEN 1 ELSE 0 END) AS total_controlled'),
                DB::raw('(100 * SUM(CASE WHEN md.controlled_by_cc_at IS NOT NULL THEN 1 ELSE 0 END)) / NULLIF(COUNT(cp.id) - SUM(CASE WHEN md.is_disabled = 1 THEN 1 ELSE 0 END), 0) AS control_rate'),
            ]);
        } elseif (hasRole('cdcr')) {
            $this->query->addSelect([
                DB::raw('SUM(CASE WHEN md.controlled_by_cdcr_at IS NOT NULL THEN 1 ELSE 0 END) AS total_controlled'),
                DB::raw('(100 * SUM(CASE WHEN md.controlled_by_cdcr_at IS NOT NULL THEN 1 ELSE 0 END)) / NULLIF(COUNT(cp.id) - SUM(CASE WHEN md.is_disabled = 1 THEN 1 ELSE 0 END), 0) AS control_rate'),
            ]);
        } elseif (hasRole('dcp')) {
            $this->query->addSelect([
                DB::raw('SUM(CASE WHEN md.controlled_by_dcp_at IS NOT NULL THEN 1 ELSE 0 END) AS total_controlled'),
                DB::raw('(100 * SUM(CASE WHEN md.controlled_by_dcp_at IS NOT NULL THEN 1 ELSE 0 END)) / NULLIF(COUNT(cp.id) - SUM(CASE WHEN md.is_disabled = 1 THEN 1 ELSE 0 END), 0) AS control_rate')
            ]);
        } elseif (hasRole(['root', 'admin'])) {
            $this->query->addSelect([
                DB::raw('(100 * SUM(CASE WHEN md.controlled_by_cdc_at IS NOT NULL THEN 1 ELSE 0 END)) / NULLIF(COUNT(cp.id) - SUM(CASE WHEN md.is_disabled = 1 THEN 1 ELSE 0 END), 0) AS control_rate_cdc'),
                DB::raw('(100 * SUM(CASE WHEN md.controlled_by_cc_at IS NOT NULL THEN 1 ELSE 0 END)) / NULLIF(COUNT(cp.id) - SUM(CASE WHEN md.is_disabled = 1 THEN 1 ELSE 0 END), 0) AS control_rate_cc'),
                DB::raw('(100 * SUM(CASE WHEN md.controlled_by_cdcr_at IS NOT NULL THEN 1 ELSE 0 END)) / NULLIF(COUNT(cp.id) - SUM(CASE WHEN md.is_disabled = 1 THEN 1 ELSE 0 END), 0) AS control_rate_cdcr'),
                DB::raw('(100 * SUM(CASE WHEN md.controlled_by_dcp_at IS NOT NULL THEN 1 ELSE 0 END)) / NULLIF(COUNT(cp.id) - SUM(CASE WHEN md.is_disabled = 1 THEN 1 ELSE 0 END), 0) AS control_rate_dcp')
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
        $this->query->where('m.id', $this->mission->id);
    }

    /**
     * Set different columns to group by
     *
     * @return void
     */
    protected function setGroups(): void
    {
        $this->query->groupBy('m.id', 'f.id', 'd.id', 'p.id', 'p.name', 'd.name',  'f.name', 'p.display_priority', 'p.updated_at', 'd.display_priority', 'd.updated_at', 'f.display_priority', 'f.updated_at');
    }
}
