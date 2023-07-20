<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MissionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        isAbleOrAbort('view_mission');
        return [
            'id' => $this->id,
            'campaign' => $this->campaign->reference,
            'reference' => $this->reference,
            'dre' => $this->dre->full_name,
            'agency' => $this->agency->full_name,
            'state' => $this->realisation_state,
            'end' => $this->end,
            'start' => $this->programmed_start->format('d-m-Y'),
            'agency_controllers_str' => $this->dre_controllers_str,
            'remaining_days_before_start' => $this->remaining_days_before_start,
            'progress_status' => $this->progress_status,
            'avg_score' => $this->avg_score,
            'is_validated_by_dcp' => $this->is_validated_by_dcp,
            'is_validated_by_cdcr' => $this->is_validated_by_cdcr,
            'is_validated_by_cdc' => $this->is_validated_by_cdc,
            'is_validated_by_ci' => $this->is_validated_by_ci,
            'is_validated_by_cc' => $this->is_validated_by_cc,
        ];
    }
}
