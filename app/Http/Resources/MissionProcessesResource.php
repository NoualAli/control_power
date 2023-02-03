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
        return [
            'id' => $this->id,
            'familly' => $this->familly->name,
            'domain' => $this->domain->name,
            'name' => $this->name,
            'controlPoints' => $this->control_points,
            'control_points_count' => $this->control_points_count,
            'progress_status' => $this->progress_status,
            'avg_score' => $this->avg_score
        ];
    }
}