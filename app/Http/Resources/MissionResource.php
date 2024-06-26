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
            'end_date' => $this->end_date,
            'start_date' => $this->start_date,
            'remaining_days_before_start' => $this->remainingDaysBeforeStartStr($this->remaining_days_before_start, $this->remaining_days_before_end),
            'progress_status' => $this->total_controlled_md ? number_format($this->total_controlled_md * 100 / $this->total_md) : 0,
            'avg_score' => (float) $this->avg_score,
            'is_validated_by_dcp' => $this->is_validated_by_dcp,
            'is_validated_by_cdcr' => $this->is_validated_by_cdcr,
            'is_validated_by_cdc' => $this->is_validated_by_cdc,
            'is_validated_by_ci' => $this->is_validated_by_ci,
            'is_validated_by_cc' => $this->is_validated_by_cc,
            'is_late_ci' => (bool) $this->is_late_ci,
            'is_late_cdc' => (bool) $this->is_late_cdc,
            'is_late_cdcr' => (bool) $this->is_late_cdcr,
            'is_late_dcp' => (bool) $this->is_late_dcp,
            'is_late_da' => (bool) $this->is_late_da,
            'is_late' => (bool) $this->is_late,
            // 'is_late_user' => $this->is_late_user,
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
