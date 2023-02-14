<?php

namespace App\Models;

use App\Traits\HasDates;
use App\Traits\HasUuid;
use App\Traits\IsOrderable;
use App\Traits\IsSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Znck\Eloquent\Traits\BelongsToThrough;

class Mission extends Model
{
    use HasFactory, BelongsToThrough, HasRelationships, SoftDeletes, IsSearchable, IsOrderable, HasUuid, HasDates;

    protected $fillable = [
        'reference',
        'control_campaign_id',
        'agency_id',
        'created_by_id',
        'controlled_by_id',
        'note',
        'start',
        'end'
    ];

    protected $appends = [
        'remaining_days_before_start',
        'remaining_days_before_end',
        'remaining_days_before_start_str',
        'remaining_days_before_end_str',
        'progress_status',
        'realisation_state',
        'avg_score',
        'controller_opinion',
        'head_of_department_report',
        'synthesis'
    ];

    protected $searchable = ['reference', 'campaign.reference'];

    // public $with = ['agency', 'dre', 'campaign', 'controllers', 'details'];

    /**
     * Getters
     */
    public function getReferenceAttribute($reference)
    {
        if (!$this->head_of_department_report && !$this->head_of_department_report?->is_validated) {
            return str_replace('RAP', '', $reference);
        }
        return $reference;
    }

    public function getAvgScoreAttribute()
    {
        return addZero(intval($this->details->avg('score')));
    }

    public function getAgencyControllersStrAttribute()
    {
        return implode(', ', $this->agencyControllers->pluck('full_name')->toArray());
    }

    public function getProgressStatusAttribute()
    {
        $totalDetails = $this->details()->count();
        $totalFinishedDetails = $this->details->filter(fn ($detail) => $detail->score !== null)->count();
        return number_format($totalFinishedDetails * 100 / $totalDetails);
    }

    public function getControllerOpinionAttribute()
    {
        return $this->reports->where('type', 'Avis contrôleur')->first();
    }

    public function getHeadOfDepartmentReportAttribute()
    {
        return $this->reports->where('type', 'Rapport')->first();
    }

    public function getSynthesisAttribute()
    {
        return $this->reports->where('type', 'Synthèse')->first();
    }
    public function getRealisationStateAttribute()
    {
        // if (!$this->remaining_days_before_end) {
        //     return 'EN RETARD';
        // }

        if ($this->remaining_days_before_start) {
            return 'À RÉALISER';
        }

        if (!$this->controller_opinion) {
            if (!$this->remaining_days_before_end) {
                return 'EN RETARD';
            }
            return 'EN COURS';
        } elseif ($this->controller_opinion && $this->controller_opinion->is_validated && !$this->head_of_department_report) {
            return 'En attente de validation';
        } elseif ($this->head_of_department_report) {
            return 'Validé et envoyé';
        } else {
            return 'RÉALISÉ';
        }
        // if ($this->validated_at) {
        //     return 'RÉALISÉ';
        // } else {
        //     if ($this->remaining_days_before_end < 0) {
        //         return 'EN RETARD';
        //     } else {
        //         if ($this->details()->count()) {
        //             return 'EN COURS';
        //         } else {
        //             return 'À RÉALISER';
        //         }
        //     }
        // }
    }

    /**
     * Relationships
     */
    public function agencyControllers()
    {
        return $this->belongsToMany(User::class, 'mission_has_controllers')->wherePivot('control_agency', true);
    }

    public function dcpControllers()
    {
        return $this->belongsToMany(User::class, 'mission_has_controllers')->wherePivot('control_agency', false);
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

    /**
     * Scopes
     */
    public function scopeValidated($query)
    {
        return $query->whereRelation('reports', 'type', 'Rapport')->whereRelation('reports', 'validated_at', '!=', null);
    }

    public function scopeNotValidated($query)
    {
        return $query->where('report', '!=', null)->where('validated_at', null);
    }

    // public function scopeHasDetails($query)
    // {
    //     return $query->whereHas('details');
    // }

    // public function scopeTotalAnomalies($query)
    // {
    //     return $query->with('details', fn ($query) => $query->whereIn('score', [2, 3, 4]));
    // }
}