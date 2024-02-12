<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

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
        $isDisabled = boolval(intval($this->is_disabled));
        $data =  [
            'id' => $this->process_id,
            'family' => $this->family,
            'domain' => $this->domain,
            'process' => $this->process,
            'control_points_count' => $this->control_points_count,
            'progress_status' => $isDisabled ? '-' : number_format($this->progress_status, 0, '') . '%',
            'progress_status_num' => $isDisabled ? 0 : $this->progress_status,
            'avg_score' => $isDisabled ? '-' : intval($this->avg_score),
            'total_anomalies' => $isDisabled ? '-' : $this->total_anomalies,
            'anomalies_rate' => $isDisabled ? '-' : $this->anomalies_rate . '%',
            'major_fact' => $isDisabled ? '-' : $this->major_fact,
            'is_disabled' => $isDisabled,
            'assigned_to_cc_id' => $this->assigned_to_cc_id
        ];

        if (hasRole(['ci', 'cdc'])) {
            unset($data['avg_score']);
        }

        if (!hasRole(['cc', 'cdcr', 'dcp'])) {
            $data['assigned_to_cc_id'] = null;
        }

        if (hasRole(['cc', 'cdcr', 'dcp'])) {
            $data['cc_full_name'] = $data['assigned_to_cc_id'] ? normalizeFullName(getUserFullNameWithRole($data['assigned_to_cc_id'])) : '-';
        }

        return $data;
    }
}
