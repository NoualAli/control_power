<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ControlPointResource extends JsonResource
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
            'domain_name' => $this->domain_name,
            'process_name' => $this->process_name,
            'has_major_fact' => boolval($this->has_major_fact),
            'usable_for_agency' => boolval($this->usable_for_agency),
            'usable_for_dre' => boolval($this->usable_for_dre),
            'is_active' => boolval($this->is_active),
            'process_is_active' => boolval($this->process_is_active),
            'creator_full_name' => $this->creator_full_name ?: 'Système',
            'created_at' => $this->created_at ? Carbon::parse($this->created_at)->format('d-m-Y') : '-',
            'updater_full_name' => $this->updater_full_name ?: '-',
            'updated_at' => $this->updated_at ? Carbon::parse($this->updated_at)->format('d-m-Y') : '-',
            'display_priority' => intval($this->display_priority),
            'field_count' =>  intval($this->field_count),
        ];
    }
}