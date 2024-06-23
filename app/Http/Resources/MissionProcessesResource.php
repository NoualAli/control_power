<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class MissionProcessesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $isDisabled = $this->checkIfDisabled();
        $data =  [
            'id' => $this->process_id,
            'family' => $this->family,
            'domain' => $this->domain,
            'process' => $this->process,
            'control_points_count' => $isDisabled ? '-' : $this->activated_control_points_count,
            'progress_rate' => $isDisabled ? '-' : number_format($this->progress_rate, 0, '') . '%',
            'progress_rate_num' => $isDisabled ? 0 : $this->progress_rate,
            'avg_score' => $isDisabled ? '-' : intval($this->avg_score),
            'total_anomalies' => $isDisabled ? '-' : $this->total_anomalies,
            'anomalies_rate' => $isDisabled ? '-' : $this->anomalies_rate . '%',
            'major_fact' => $isDisabled ? '-' : $this->major_fact,
            'is_disabled' => $isDisabled,
        ];

        if (hasRole(['ci', 'cdc', 'da'])) {
            unset($data['avg_score']);
        }

        if (hasRole(['cdcr', 'dcp', 'cc', 'cdc'])) {
            $data['control_rate'] = $this->control_rate . '%';
        }

        if (hasRole(['root', 'admin'])) {
            $data['control_rate_cdc'] = $this->control_rate_cdc . '%';
            $data['control_rate_cc'] = $this->control_rate_cc . '%';
            $data['control_rate_cdcr'] = $this->control_rate_cdcr . '%';
            $data['control_rate_dcp'] = $this->control_rate_dcp . '%';
        }

        return $data;
    }

    private function checkIfDisabled()
    {
        $isDisabled = DB::table('mission_details AS md')
            ->select(DB::raw('SUM(CASE WHEN md.is_disabled = 1 THEN 1 ELSE 0 END) AS total_disabled'), DB::raw('COUNT(md.is_disabled) AS total'))
            ->leftJoin('control_points AS cp', 'cp.id', 'md.control_point_id')
            ->leftJoin('processes AS p', 'p.id', 'cp.process_id')
            ->where('mission_id', $this->mission_id)
            ->where('p.id', $this->process_id)
            ->groupBy('p.id')
            ->get()->first();
        $totalDisabled = intval($isDisabled?->total_disabled);
        $total = intval($isDisabled?->total);

        return intval($totalDisabled) == intval($total);
    }
}
