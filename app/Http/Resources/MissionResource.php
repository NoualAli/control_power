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
        $data = [
            'id' => $this->id,
            'campaign' => $this->campaign,
            'reference' => $this->reference,
            'dre' => $this->dre,
            'agency' => $this->agency,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
            'progress_rate' => formatNumber($this->progress_rate),
            'dre_controller_full_name' => normalizeFullName($this->dre_controller_full_name),

            'is_validated_by_dcp' => boolval($this->is_validated_by_dcp),
            'is_validated_by_cdc' => boolval($this->is_validated_by_cdc),
            'is_late' => boolval($this->is_late),
            'avg_score' => $this->avg_score,
            'current_state' => (int) $this->current_state,
            'remaining_days_before_start' => $this->remaining_days_before_start,
        ];

        if (hasRole(['cdcr', 'dcp', 'cc', 'root', 'admin'])) {
            $data['dcp_controller_full_name'] = trim($this->dcp_controller_full_name) ? normalizeFullName($this->dcp_controller_full_name) : '-';
        } elseif (hasRole(['der'])) {
            $data['der_controller_full_name'] = trim($this->der_controller_full_name) ? normalizeFullName($this->der_controller_full_name) : '-';
        } elseif (hasRole(['da'])) {
            unset($data['dre_controller_full_name']);
        }

        if (hasRole(['ci', 'cdc', 'da', 'dre', 'ir', 'cder', 'der'])) {
            unset($data['avg_score']);
        }

        return $data;
    }
}
