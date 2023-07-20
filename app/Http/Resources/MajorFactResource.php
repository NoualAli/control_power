<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MajorFactResource extends JsonResource
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
            'cdc_reference' => $this->mission->campaign->reference,
            'mission_reference' => $this->mission->reference,
            'dre_full_name' => $this->agency->dre->full_name,
            'agency_full_name' => $this->agency->full_name,
            'familly_name' => $this->controlPoint->process->domain->familly->name,
            'domain_name' => $this->controlPoint->process->domain->name,
            'process_name' => $this->controlPoint->process->name,
            'control_point_name' => $this->controlPoint->name,
            'is_regularized' => $this->is_regularized,
            'is_dispatched' => $this->major_fact_dispatched_at ? $this->major_fact_dispatched_at->diffForHumans() : '-',
        ];
    }
}
