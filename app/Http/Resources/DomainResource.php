<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class DomainResource extends JsonResource
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
            'name' => $this->name,
            'family_name' => $this->family_name,
            'usable_for_agency' => boolval($this->usable_for_agency),
            'usable_for_dre' => boolval($this->usable_for_dre),
            'is_active' => boolval($this->is_active),
            'family_is_active' => boolval($this->family_is_active),
            'creator_full_name' => $this->creator_full_name ?: 'Système',
            'created_at' => $this->created_at ? Carbon::parse($this->created_at)->format('d-m-Y') : '-',
            'updater_full_name' => $this->updater_full_name ?: '-',
            'updated_at' => $this->updated_at ? Carbon::parse($this->updated_at)->format('d-m-Y') : '-',
            'display_priority' => intval($this->display_priority),
            'processes_count' => intval($this->processes_count),
            'is_deletable' => boolval($this->is_deletable),
        ];
    }
}