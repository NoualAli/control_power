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
        if (hasRole('ci')) {
            $isLate = $this->is_late_ci;
        } elseif (hasRole('cdc')) {
            $isLate = $this->is_late_ci || $this->is_late_cdc;
        } elseif (hasRole('da')) {
            $isLate = $this->is_late_da;
        } else {
            $isLate = $this->is_late_ci || $this->is_late_cdc;
        }

        return [
            'id' => $this->id,
            'campaign' => $this->campaign,
            'reference' => $this->reference,
            'dre' => $this->dre,
            'agency' => $this->agency,
            'current_state' => (int) $this->current_state,
            'end_date' => $this->end_date,
            'start_date' => $this->start_date,
            'remaining_days_before_start' => $this->remaining_days_before_start,
            'progress_status' => $this->total_controlled_md ? number_format($this->total_controlled_md * 100 / $this->total_md) : 0,
            'avg_score' => $this->avg_score,
            'is_validated_by_dcp' => $this->is_validated_by_dcp,
            'is_validated_by_cdcr' => $this->is_validated_by_cdcr,
            'is_validated_by_cdc' => $this->is_validated_by_cdc,
            'is_validated_by_ci' => $this->is_validated_by_ci,
            'is_validated_by_cc' => $this->is_validated_by_cc,
            'is_late_ci' => (bool) $this->is_late_ci,
            'is_late_cdc' => (bool) $this->is_late_cdc,
            'is_late' => (bool) $isLate,
            'dre_controller_full_name' => normalizeFullName($this->dre_controller_full_name),
            'dcp_controller_full_name' => trim($this->dcp_controller_full_name) ? normalizeFullName($this->dcp_controller_full_name) : '-',
        ];
    }
}
