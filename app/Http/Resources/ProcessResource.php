<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcessResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // dd($this);
        return [
            'id' => $this->id,
            'name' => isset($this?->name) ? $this?->name : $this->process,
            'control_points_count' => $this->control_points_count,
            'domain_name' => isset($this?->domain?->name) ? $this?->domain?->name : $this->domain,
            'family_name' => isset($this?->family?->name) ? $this?->family?->name : $this->family,
        ];
    }
}
