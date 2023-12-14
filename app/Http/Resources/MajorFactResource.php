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
        $majorFactIsPending = $this->major_fact_is_pending;
        if (hasRole(['cdc', 'ci'])) {
            $majorFactIsDispatched = $this->major_fact_is_dispatched_to_dcp;
        } else {
            $majorFactIsDispatched = $this->major_fact_is_dispatched_by_dcp;
        }

        return [
            'id' => $this->id,
            'cdc_reference' => $this->campaign,
            'mission_reference' => $this->mission,
            'dre_full_name' => $this->dre,
            'agency_full_name' => $this->agency,
            'family_name' => $this->family,
            'domain_name' => $this->domain,
            'process_name' => $this->process,
            'control_point_name' => $this->control_point,
            'is_validated' => (bool) $majorFactIsDispatched,
            'is_pending' => (bool) $majorFactIsPending,
        ];
    }
}
