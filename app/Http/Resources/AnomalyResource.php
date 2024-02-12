<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AnomalyResource extends JsonResource
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
            'reference' => strtoupper($this->reference),
            'campaign' => $this->campaign,
            'mission' => $this->mission,
            'dre' => $this->dre,
            'agency' => $this->agency,
            'family' => $this->family,
            'domain' => $this->domain,
            'process' => $this->process,
            'control_point' => $this->control_point,
            'score' => $this->score,
            'is_regularized' => $this->reg_is_regularized,
            'is_rejected' => $this->reg_is_rejected,
            'is_sanitation_in_progress' => $this->reg_is_sanitation_in_progress,
            'state' => $this->state(),
            'is_controlled' => $this->isControlled(),
        ];
    }

    private function state()
    {
        $isRegularized = boolval($this->reg_is_regularized);
        $isRejected = boolVal($this->reg_is_rejected);
        if (!$this->reg_is_sanitation_in_progress) {
            if ($isRegularized && !$isRejected) {
                return 'Levée';
            } elseif ($isRegularized && !$isRejected) {
                return 'Levée et validée';
            } elseif (!$isRegularized && !$isRejected) {
                return 'Non levée';
            } elseif (!$isRegularized && $isRejected) {
                return 'Rejetée';
            }
        } else {
            return "En cours d'assainissement";
        }
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
