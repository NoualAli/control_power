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
        $data =  [
            'id' => $this->process_id,
            'family' => $this->family,
            'domain' => $this->domain,
            'name' => $this->process,
            'control_points_count' => $this->control_points_count,
            'progress_status' => number_format($this->progress_status, 0, ''),
            'avg_score' => intval($this->avg_score),
            'total_anomalies' => $this->total_anomalies,
            'anomalies_rate' => $this->anomalies_rate,
            'major_fact' => $this->major_fact,
        ];
        if (hasRole(['ci', 'cdc'])) {
            unset($data['avg_score']);
        }

        return $data;
    }
}
