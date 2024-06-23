<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class FamilyResource extends JsonResource
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
            'id' => intval($this->id),
            'name' => $this->name,
            // 'code' => $this->code ?: '-',
            // 'usable_for_agency' => boolval($this->usable_for_agency),
            // 'usable_for_dre' => boolval($this->usable_for_dre),
            'is_active' => boolval($this->is_active),
            'display_priority' => intval($this->display_priority),
            // 'creator_full_name' => $this->creator_full_name ?: 'Système',
            // 'created_at' => $this->created_at ? Carbon::parse($this->created_at)->format('d-m-Y H:i') : '-',
            // 'updater_full_name' => $this->updater_full_name ?: '-',
            'updated_at' => $this->updated_at ? Carbon::parse($this->updated_at)->format('d-m-Y H:i') : '-',
            'domains_count' => intval($this->domains_count),
            'processes_count' => intval($this->processes_count),
            'control_points_count' => intval($this->control_points_count),
            'control_campaigns_count' => intval($this->control_campaigns_count),
            'missions_count' => intval($this->missions_count),
            'anomalies_count' => intval($this->anomalies_count),
            'regularizations_count' => intval($this->regularizations_count),
            'regularizations_rate' => intval($this->regularizations_rate) . '%',
            'is_deletable' => boolval($this->is_deletable),
        ];
    }
}
