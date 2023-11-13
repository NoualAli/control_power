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
            'id' => $this->id,
            'campaign' => $this->campaign,
            'mission' => $this->mission,
            'dre' => $this->dre,
            'agency' => $this->agency,
            'family' => $this->family,
            'domain' => $this->domain,
            'process' => $this->process,
            'control_point' => $this->control_point,
            'score' => $this->score,
            'is_regularized' => $this->is_regularized,
            'is_regularized_str' => $this->is_regularized ? 'Levée' : 'Non levée',
            'is_controlled' => $this->isControlled(),
        ];
    }

    private function isControlled()
    {
        if (hasRole('ci')) {
            return $this->controlled_by_ci_at ? 'Oui' : 'Non';
        } elseif (hasRole('cdc')) {
            return $this->controlled_by_cdc_at ? 'Oui' : 'Non';
        } elseif (hasRole('cc')) {
            return $this->controlled_by_cc_at ? 'Oui' : 'Non';
        } elseif (hasRole('cdcr')) {
            return $this->controlled_by_cdcr_at ? 'Oui' : 'Non';
        } elseif (hasRole('dcp')) {
            return $this->controlled_by_dcp_at ? 'Oui' : 'Non';
        }
    }
}
