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
            'campaign' => $this->campaign,
            'reference' => $this->reference,
            'dre' => $this->dre,
            'agency' => $this->agency,
            'current_state' => (int) $this->current_state,
            'end_date' => Carbon::parse($this->end_date)->format('d-m-Y'),
            'start_date' => Carbon::parse($this->start_date)->format('d-m-Y'),
            'remaining_days_before_start' => $this->remainingDaysBeforeStartStr($this->remaining_days_before_start, $this->remaining_days_before_end),
            'progress_status' => $this->total_controlled_md ? number_format($this->total_controlled_md * 100 / $this->total_md) : 0,
            'avg_score' => (float) $this->avg_score,
            'is_validated_by_dcp' => $this->is_validated_by_dcp,
            'is_validated_by_cdcr' => $this->is_validated_by_cdcr,
            'is_validated_by_cdc' => $this->is_validated_by_cdc,
            'is_validated_by_ci' => $this->is_validated_by_ci,
            'is_validated_by_cc' => $this->is_validated_by_cc,
            'is_late' => (bool) $this->is_late
        ];
    }

    /**
     * @return string
     */
    private function remainingDaysBeforeStartStr($remaining_days_before_start, $remaining_days_before_end): string
    {
        $remainingDays = $remaining_days_before_start > 1 ? $remaining_days_before_start . ' jours' : $remaining_days_before_start . ' jour';

        if ($remaining_days_before_start < 0 && $remaining_days_before_end) {
            return 'En cours';
        }
        return $remaining_days_before_end ? $remainingDays : '-';
    }
}
