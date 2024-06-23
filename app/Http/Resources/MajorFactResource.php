<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MajorFactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $majorFactIsRejected = ($this->major_fact_is_rejected_at_dre || $this->major_fact_is_rejected_at_dcp);
        if (hasRole(['cdc', 'ci'])) {
            $majorFactIsDispatched = $this->major_fact_is_dispatched_to_dcp;
        } else {
            $majorFactIsDispatched = $this->major_fact_is_dispatched_by_dcp;
        }

        $majorFactIsPending = !$majorFactIsDispatched && !$majorFactIsRejected;

        return [
            'id' => $this->id,
            'reference' => $this->reference,
            'cdc_reference' => $this->campaign,
            'mission_reference' => $this->mission,
            'dre' => $this->dre,
            'agency' => $this->agency,
            'family' => $this->family,
            'domain' => $this->domain,
            'process' => $this->process,
            'control_point' => $this->control_point,
            'major_fact_is_validated' => (bool) $majorFactIsDispatched,
            'major_fact_is_pending' => (bool) $majorFactIsPending,
            'major_fact_is_rejected' => (bool) $majorFactIsRejected,
            'is_regularized' => $this->reg_is_regularized,
            'is_rejected' => $this->reg_is_rejected,
            'is_sanitation_in_progress' => $this->reg_is_sanitation_in_progress,
            'state' => $this->state(),
            'is_controlled' => $this->isControlled()
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
                return 'En attente de traitement';
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
