<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PCFResource extends JsonResource
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
            'family_name' => $this->family->name,
            'domain_name' => $this->domain->name,
            'process_name' => $this->process->name,
            'control_point_name' => $this->name,
            'scores_str' => $this->scores_str
        ];
    }
}
