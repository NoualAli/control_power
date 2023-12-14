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
            'created_by_id' => $this->created_by_id,
            'validated_by_id' => $this->validated_by_id,
            'reference' => $this->reference,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'remaining_days_before_start' => $this->remaining_days_before_start,
            'remaining_days_before_end' => $this->remaining_days_before_end,
            'remaining_days_before_start_str' => $this->remainingDaysBeforeStartStr(),
            'remaining_days_before_end_str' => $this->remainingDaysBeforeEndStr(),
            'is_validated' => $this->is_validated,
            'is_for_testing' => $this->is_for_testing_str
        ];
    }

    /**
     * @return string
     */
    private function remainingDaysBeforeStartStr(): string
    {
        // dd($this->remaining_days_before_start, $this->remaining_days_before_end, $this->reference);
        if ($this->remaining_days_before_start <= 0 && $this->remaining_days_before_end >= 0) {
            return 'En cours';
        } else {
            $remainingDays = $this->remaining_days_before_start < 1 ? $this->remaining_days_before_start . ' jours' : $this->remaining_days_before_start . ' jour';
            return $this->remaining_days_before_end > 0 ? $remainingDays : '-';
        }
    }

    /**
     * @return string
     */
    private function remainingDaysBeforeEndStr(): string
    {
        $remainingDays = $this->remaining_days_before_end > 1 ? $this->remaining_days_before_end . ' jours' : $this->remaining_days_before_end . ' jour';
        return $this->remaining_days_before_end > 0 ? $remainingDays : '-';
    }
}
