<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MissionDetailResource extends JsonResource
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
            'cdc_reference' => $this->campaign->reference,
            'mission_reference' => $this->mission->reference,
            'dre_full_name' => $this->dre->full_name,
            'agency_full_name' => $this->agency->full_name,
            'familly_name' => $this->familly->name,
            'domain_name' => $this->domain->name,
            'process_name' => $this->process->name,
            'control_point_name' => $this->controlPoint->name,
            'major_fact_str' => $this->major_fact_str,
            'score' => $this->score,
            'report' => $this->report,
            'recovery_plan' => $this->recovery_plan,
            'appreciation' => $this->appreciation,
            'parsed_metadata' => $this->parsed_metadata,
            'metadata' => $this->metadata
        ];
    }
}
