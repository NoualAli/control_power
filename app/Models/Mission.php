<?php

namespace App\Models;

use App\Traits\HasDates;
use App\Traits\HasScopes;
use App\Traits\HasUuid;
use App\Traits\IsFilterable;
use App\Traits\IsSortable;
use App\Traits\IsSearchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Znck\Eloquent\Traits\BelongsToThrough;

class Mission extends BaseModel
{
    use HasFactory, BelongsToThrough, HasRelationships, SoftDeletes, IsSearchable, IsSortable, HasUuid, HasDates, HasScopes, IsFilterable;

    protected $filter = 'App\Filters\Mission';

    protected $fillable = [
        'reference',
        'control_campaign_id',
        'agency_id',
        'created_by_id',
        'controlled_by_id',
        'note',
        'start',
        'end',
        'cdcr_validation_by_id',
        'dcp_validation_by_id',
        'cdcr_validation_at',
        'dcp_validation_at',
        'state'
    ];

    protected $appends = [
        'remaining_days_before_start',
        'remaining_days_before_end',
        'remaining_days_before_start_str',
        'remaining_days_before_end_str',
        'progress_status',
        'realisation_state',
        'avg_score',
        'opinion',
        'dre_report',
        'synthesis',
        'controller_opinion_exist',
        'dre_report_exist',
        'controller_opinion_is_validated',
        'dre_report_is_validated',
    ];

    protected $searchable = ['reference', 'campaign.reference'];

    // public $with = ['agency', 'dre', 'campaign', 'controllers', 'details'];

    /**
     * Getters
     */
    public function getHasDcpControllersAttribute()
    {
        return $this->dcpControllers->count();
    }
    public function getHasDreControllersAttribute()
    {
        return $this->dreControllers->count();
    }

    public function getDreReportExistAttribute()
    {
        return $this->dre_report !== null;
    }

    public function getDreReportIsValidatedAttribute()
    {
        return $this->dre_report?->is_validated;
    }

    public function getControllerOpinionExistAttribute()
    {
        return $this->opinion !== null;
    }

    public function getControllerOpinionIsValidatedAttribute()
    {
        return $this->opinion?->is_validated;
    }

    public function getReferenceAttribute($reference)
    {
        if (!$this->dre_report_is_validated && !$this->dre_report_is_validated) {
            return str_replace('RAP', '', $reference);
        }
        return $reference;
    }

    public function getAvgScoreAttribute()
    {
        $details = $this->details()->whereIn('score', [1, 2, 3, 4]);
        $sum = round($details->sum('score'));
        $count = $details->count();
        return $sum > 0 && $count > 0 ? addZero(round($sum / $count)) : 0;
        // return addZero($details->avg('score'));
    }

    public function getAgencyControllersStrAttribute()
    {
        return implode(', ', $this->agencyControllers->pluck('full_name')->toArray());
    }

    public function getProgressStatusAttribute()
    {
        $totalDetails = $this->details->count();
        $totalFinishedDetails = $this->details->filter(fn ($detail) => $detail->score !== null)->count();
        return $totalFinishedDetails ? number_format($totalFinishedDetails * 100 / $totalDetails) : 0;
    }

    public function getOpinionAttribute()
    {
        return $this->reports->where('type', 'Avis contrôleur')->first();
    }

    public function getDreReportAttribute()
    {
        return $this->reports->where('type', 'Rapport')->first();
    }

    public function getCdcrValidationAtAttribute($cdcr_validation_at)
    {
        return $cdcr_validation_at ? Carbon::parse($cdcr_validation_at)->format('d-m-Y') : null;
    }

    public function getDcpValidationAtAttribute($dcp_validation_at)
    {
        return $dcp_validation_at ? Carbon::parse($dcp_validation_at)->format('d-m-Y') : null;
    }

    public function getSynthesisAttribute()
    {
        return $this->reports->where('type', 'Synthèse')->first();
    }
    public function getRealisationStateAttribute()
    {
        // return $this->states()->latest()->first()->state;
        $today = now();
        $start = $this->start;
        $end = $this->end;
        $report = $this->dre_report;
        $comment = $this->opinion;
        $cdcrValidationBy = $this->cdcr_validation_by_id;
        $dcpValidationBy = $this->dcp_validation_by_id;
        $progressStatus = $this->progress_status;
        $startDiff = $today->diffInDays($start, false);
        $endDiff = $today->diffInDays($end, false);
        // dd($progressStatus >= 100, $comment?->is_validated, $report?->is_validated);
        if ($startDiff >= 0 && $progressStatus == 0) {
            return 'À réaliser';
        } else if ($startDiff < 0 && $endDiff >= 0 && $progressStatus <= 100) {
            return 'En cours';
        } else if ($progressStatus >= 100 && ($comment && $comment->is_validated && (!$report || ($report && !$report->is_validated)) || !$comment)) {
            return 'En attente de validation';
        } else if ($progressStatus >= 100 && $report?->is_validated && !$cdcrValidationBy) {
            return 'Validé et envoyé';
        } else if ($progressStatus >= 100 && $report?->is_validated && $cdcrValidationBy && !$dcpValidationBy) {
            return '1ère validation';
        } else if ($progressStatus >= 100 && $report?->is_validated && $dcpValidationBy) {
            return '2ème validation';
        } else if ($endDiff < 0 && $progressStatus < 100 && (!$comment?->is_validated || !$report?->id_validated)) {
            return 'En retard';
        } else {
            return 'Indéterminé';
        }
    }

    /**
     * Relationships
     */
    public function controllers()
    {
        return $this->belongsToMany(User::class, 'mission_has_controllers')->withPivot('control_agency');
    }
    public function agencyControllers()
    {
        return $this->controllers()->wherePivot('control_agency', true);
    }

    public function dcpControllers()
    {
        return $this->controllers()->wherePivot('control_agency', false);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
    public function agency()
    {
        return $this->belongsTo(Agency::class);
    }
    public function dre()
    {
        return $this->belongsToThrough(Dre::class, Agency::class);
    }
    public function campaign()
    {
        return $this->belongsTo(ControlCampaign::class, 'control_campaign_id');
    }
    public function details()
    {
        return $this->hasMany(MissionDetail::class);
    }

    public function reports()
    {
        return $this->hasMany(MissionReport::class);
    }
    public function cdcrValidator()
    {
        return $this->belongsTo(User::class, 'cdcr_validation_by_id');
    }

    public function dcpValidator()
    {
        return $this->belongsTo(User::class, 'dcp_validation_by_id');
    }

    public function states()
    {
        return $this->hasMany(MissionState::class);
    }

    public function state()
    {
        return $this->belongsTo(MissionState::class);
    }

    /**
     * Scopes
     */
    public function scopeHasControllers($query)
    {
        return $query->whereHas('controllers');
    }
    public function scopeHasDcpControllers($query)
    {
        return $query->whereHas('dcpControllers');
    }
    public function scopeHasDreControllers($query)
    {
        return $query->whereHas('dreControllers');
    }
    public function scopeHasCdcrValidation($query)
    {
        return $query->whereNotNull('cdcr_validation_at');
    }
    public function scopeHasDcpValidation($query)
    {
        return $query->whereNotNull('dcp_validation_at');
    }
    public function scopeExecuted($query)
    {
        return $query->whereRelation('reports', 'type', 'Avis contrôleur', '!=', null)->whereRelation('reports', 'validated_at', '!=', null);
    }
    public function scopeValidated($query)
    {
        // return $query->whereHas('reports', fn ($report) => $report->where('type', 'Rapport')->whereNotNull('validated_at'));
        return $query->whereRelation('reports', 'type', 'Rapport', '!=', null)->whereRelation('reports', 'validated_at', '!=', null);
    }

    public function scopeNotValidated($query)
    {
        // return $query->where
        // return $query->whereHas('states', function ($q) {
        //     $q->where('state', 'En attente de validation')
        //         ->whereNotExists(function ($query) {
        //             $query->select(DB::raw(1))
        //                 ->from('mission_states as ms2')
        //                 ->orderBy('created_at', 'DESC')
        //                 ->whereRaw('ms2.mission_id = mission_states.mission_id AND ms2.created_at > mission_states.created_at');
        //         });
        // });
    }

    public function scopeOnlyValidatedMajorFacts($query)
    {
        return $query->where('major_fact', true)->whereNotNull('validated_at');
    }
}
