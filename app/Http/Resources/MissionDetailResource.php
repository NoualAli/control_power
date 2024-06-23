<?php

namespace App\Http\Resources;

use App\Models\ControlPoint;
use App\Models\MissionDetail;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

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
        $data = [
            'id' => $this->id,
            'reference' => $this->reference,
            'mission' => $this->mission,
            'campaign' => $this->campaign,
            'family_id' => $this->family_id,
            'family' => $this->family,
            'domain_id' => $this->domain_id,
            'domain' => $this->domain,
            'process_id' => $this->process_id,
            'process' => $this->process,
            'control_point_id' => $this->control_point_id,
            'control_point' => $this->control_point,
            'score' => $this->score,
            'recovery_plan' => $this->recovery_plan,
            'is_controlled_by_ci' => boolval($this->is_controlled_by_ci),
            'is_controlled_by_cdc' => boolval($this->is_controlled_by_cdc),
            'is_controlled_by_cc' => boolval($this->is_controlled_by_cc),
            'is_controlled_by_cdcr' => boolval($this->is_controlled_by_cdcr),
            'is_controlled_by_dcp' => boolval($this->is_controlled_by_dcp),
            'mission_is_validated' => $this->isValidated(),
            'major_fact_is_dispatched_at' => $this->major_fact_is_dispatched_at,
            'major_fact_is_dispatched_by_dcp' => boolval($this->major_fact_is_dispatched_by_dcp),
            'major_fact_is_dispatched_to_dcp' => boolval($this->major_fact_is_dispatched_to_dcp),
            'major_fact_is_pending_at_dcp' => boolval($this->major_fact_is_pending_at_dcp),
            'major_fact_is_pending_at_dre' => boolval($this->major_fact_is_pending_at_dre),
            'cdc_full_name' => $this->cdc_full_name,
            'cdcr_full_name' => $this->cdcr_full_name,
            'dcp_full_name' => $this->dcp_full_name,
            'ci_full_name' => $this->ci_full_name,
            'cc_full_name' => $this->cc_full_name,
            'major_fact_is_dispatched_by_full_name' => $this->major_fact_is_dispatched_by_full_name,
            'major_fact_is_rejected_by_full_name' => $this->major_fact_is_rejected_by_full_name,
            'major_fact_is_dispatched_to_dcp_by_full_name' => $this->major_fact_is_dispatched_to_dcp_by_full_name,
            'major_fact_is_dipatched_to_dcp_at' => Carbon::parse($this->major_fact_is_dispatched_to_dcp_at)->format('d-m-Y H:i'),
            'major_fact_is_detected_by_full_name' => $this->major_fact_is_detected_by_full_name,
            'major_fact_is_detected_at' => Carbon::parse($this->major_fact_is_detected_at)->format('d-m-Y H:i'),
            'major_fact_is_rejected_at_dcp' => $this->major_fact_is_rejected_at_dcp,
            'major_fact_is_rejected_at_dre' => $this->major_fact_is_rejected_at_dre,
            'major_fact_is_rejected_at' => Carbon::parse($this->major_fact_is_rejected_at)->format('d-m-Y H:i'),
            'major_fact' => boolval($this->major_fact),
            'controlled_by_ci_at' => $this->controlled_by_ci_at,
            'controlled_by_cdc_at' => $this->controlled_by_cdc_at,
            'controlled_by_cc_at' => $this->controlled_by_cc_at,
            'controlled_by_cdcr_at' => $this->controlled_by_cdcr_at,
            'controlled_by_dcp_at' => $this->controlled_by_dcp_at,
            'metadata' => $this->metadata,
            'reg_is_regularized' => boolval($this->reg_is_regularized),
            'reg_is_rejected' => boolval($this->reg_is_rejected),
            'reg_is_sanitation_in_progress' => boolval($this->reg_is_sanitation_in_progress),
            'is_disabled' => boolval($this->is_disabled),
            'observation' => $this->getObservation(),
            'fields' => $this->getFields(),
            'appreciation' => $this->getAppreciation(),
            'has_any_regularization' => $this->checkIfHasAnyRegularization(),
        ];

        if (hasRole(['da'])) {
            $data['major_fact'] = false;
            $data['major_fact_is_dispatched_by_full_name'] = null;
            $data['major_fact_is_dispatched_to_dcp_by_full_name'] = null;
            $data['major_fact_is_detected_by_full_name'] = null;
            $data['major_fact_is_rejected_by_full_name'] = null;
            $data['major_fact_is_rejected_at_dre'] = null;
            $data['major_fact_is_rejected_at_dcp'] = null;
            $data['major_fact_is_detected_by_id'] = null;
            $data['major_fact_is_dispatched_to_dcp_by_id'] = null;
            $data['major_fact_is_dispatched_by_id'] = null;
            $data['major_fact_is_rejected_by_id'] = null;
            $data['major_fact_is_detected_at'] = null;
            $data['major_fact_is_rejected_at'] = null;
            $data['major_fact_is_dispatched_at'] = null;
            $data['major_fact_is_dispatched_to_dcp_at'] = null;
        }

        return $data;
    }

    private function checkIfHasAnyRegularization()
    {
        return DB::table('mission_detail_regularizations')->where('mission_detail_id', $this->id)->count();
    }

    private function getObservation()
    {
        return  DB::table('comments AS c')->whereIn('type', ['ci_observation', 'cdc_observation'])
            ->where('c.commentable_id', $this->id)->where('c.commentable_type', MissionDetail::class)
            ->orderBy('created_at', 'DESC')->first();
    }

    private function getFields()
    {
        return  DB::table('has_fields AS hf')->leftJoin('fields AS f', 'hf.field_id', 'f.id')
            ->where('attachable_type', ControlPoint::class)
            ->where('attachable_id', $this->control_point_id)
            ->orderBy('hf.created_at', 'ASC');
    }

    private function getAppreciation()
    {
        $controlPointScores = DB::table('control_points')->select('scores')->where('id', $this->control_point_id)->first();
        $controlPointScores = property_exists($controlPointScores, 'scores') ? json_decode($controlPointScores->scores) : [];
        $controlPointScores = collect($controlPointScores)->filter(fn ($score) => $score[0]->score == $this->score)->first();
        return isset($controlPointScores[1]) ? $controlPointScores[1]->label : null;
    }

    private function isValidated()
    {
        if (hasRole('cc')) {
            return boolval($this->cc_validation_by_id);
        } elseif (hasRole('cdcr')) {
            return boolval($this->cdcr_validation_by_id);
        } elseif (hasRole('dcp')) {
            return boolval($this->dcp_validation_by_id);
        }
    }
}
