<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ControlCampaignResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        isAbleOrAbort('view_control_campaign');
        return [
            'id' => $this->id,
            'reference' => $this->reference,
            'start' => $this->start,
            'end' => $this->end,
            'remaining_days_before_start_str' => $this->remaining_days_before_start_str,
            'remaining_days_before_end_str' => $this->remaining_days_before_end_str
        ];
    }
}