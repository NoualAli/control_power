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
        // if ($process) {
        //     $this->process = is_integer($process) ? Process::findOrFail($process) : $process;
        // }
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
        $this->query->orderBy('is_disabled', 'asc');
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
        $this->query = $this->query->select([
            "p.id as process_id",
            "p.name as process",
            "d.name as domain",
            "f.name as family",
            "f.id as family_id",
            "d.id as domain_id",
            DB::raw("CASE WHEN COUNT(CASE WHEN md.major_fact > 0 THEN 1 ELSE NULL END) > 0 THEN 'Oui' ELSE 'Non' END AS major_fact"),
            DB::raw("COUNT(CASE WHEN score IN (2, 3, 4) THEN 1 ELSE NULL END) AS total_anomalies"),
            DB::raw("COUNT(cp.id) as control_points_count"),
            DB::raw("AVG(md.score) as avg_score"),
            DB::raw("COUNT(md.id) AS total_mission_details"),
            DB::raw("SUM(CASE WHEN md.score IS NOT NULL THEN 1 ELSE 0 END) AS scored_mission_details"),
            DB::raw("(COUNT(CASE WHEN score IN (2, 3, 4) THEN 1 ELSE NULL END) * 100) / NULLIF(COUNT(md.id), 0) AS anomalies_rate"),
            DB::raw("(COUNT(md.score) * 100) / NULLIF(COUNT(md.id), 0) AS progress_status"),
            DB::raw("(CASE WHEN (CASE WHEN md.is_disabled = 1 THEN COUNT(md.id) ELSE 0 END) > 0 THEN 1 ELSE 0 END) as is_disabled"),
            "md.assigned_to_cc_id",
        ]);
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
        $this->query->groupBy('f.id', 'd.id', 'p.id', 'p.name', 'd.name', 'f.name', 'md.is_disabled', 'md.assigned_to_cc_id');
    }
}
