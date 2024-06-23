<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MissionStateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            'cc_reference' => $this->cc_reference,
            'cc_id' => $this->cc_id,
            'm_reference' => $this->m_reference,
            'm_id' => $this->m_id,
            'total_anomalies' => $this->total_anomalies,
            'total_regularized' => $this->total_regularized,
            'regularization_rate' =>  $this->regularization_rate > 0 ? number_format($this->regularization_rate) . '%' : 0,
        ];

        return $data;
    }
}
