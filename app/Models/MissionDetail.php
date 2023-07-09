<?php

namespace App\Models;

use App\Traits\HasMedia;
use App\Traits\HasScopes;
use App\Traits\HasUuid;
use App\Traits\IsFilterable;
use App\Traits\IsSearchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\SoftDeletes;
use Znck\Eloquent\Traits\BelongsToThrough;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class MissionDetail extends BaseModel
{
    use HasFactory, SoftDeletes, HasUuid, HasRelationships, BelongsToThrough, HasMedia, IsFilterable, IsSearchable, HasScopes;

    public $fillable = [
        'control_point_id',
        'mission_id',
        'report',
        'recovery_plan',
        'score',
        'major_fact',
        'metadata',
        'assigned_to_ci_id',
        'assigned_to_cc_id',
        'controlled_by_ci_id',
        'controlled_by_cc_id',
        'controlled_at',
        'major_fact_dispatched_at',
    ];

    protected $filter = 'App\Filters\MissionDetail';

    protected $searchable = ['mission_details-id'];

    public $with = ['process', 'domain', 'controlPoint', 'familly', 'media'];

    public $casts = [
        'metadata' => 'object',
        'controlled_at' => 'datetime:d-m-Y H:i',
        'processed_at' => 'datetime:d-m-Y H:i',
        'major_fact_dispatched_at' => 'datetime:d-m-Y H:i',
        'major_fact' => 'boolean'
    ];

    public $appends = [
        'appreciation',
        'parsed_metadata',
        'major_fact_str',
        'score_tag'
    ];

    /**
     * Getters
     */
    public function getIsAssignedToCcAttribute()
    {
        return boolval($this->assigned_to_cc_id);
    }

    public function getIsRegularizedAttribute()
    {
        return $this->regularization?->regularized_at ? 'Levée' : 'Non levée';
    }
    public function getExecutedAtAttribute($controlled_at)
    {
        return $controlled_at ? Carbon::parse($controlled_at)->format('d-m-Y H:i') : '-';
    }
    public function getProcessedAtAttribute($processed_at)
    {
        return $processed_at ? Carbon::parse($processed_at)->format('d-m-Y H:i') : '-';
    }
    public function getAppreciationAttribute()
    {
        $score = collect($this->controlPoint?->scores)->filter(fn ($score) => $score[0]->score == $this->score)->first();
        return isset($score[1]) ? $score[1]->label : null;
    }

    public function getScoreTagAttribute()
    {
        $score = intval($this->score);
        if ($score === 1) {
            $style = 'is-success';
        } else if ($score === 2) {
            $style = 'is-info';
        } else if ($score === 3) {
            $style = 'is-warning';
        } else if ($score === 4) {
            $style = 'is-danger';
        } else {
            $style = 'is-grey';
        }

        return '<div class="tag ' . $style . '">' . $score . '</div>';
    }

    public function getParsedMetadataAttribute()
    {
        return collect($this->metadata)->flatten()->groupBy('label')->map(function ($data) {
            return collect($data)->map(function ($item) {
                $item = collect($item);
                unset($item['rules']);
                $values = $item->values()->map(fn ($value, $index) => $index == 1 ? $value : null)->filter(fn ($item) => $item)->flatten();
                return $values;
            });
        });
    }
    public function getMajorFactStrAttribute()
    {
        return $this->major_fact ? '<i class="las la-times-circle text-danger text-medium icon" title="Oui"></i>' : '<i class="las la-check-circle text-success text-medium icon" title="Non"></i>';
    }
    /**
     * Relationships
     */
    public function campaign()
    {
        return $this->belongsToThrough(ControlCampaign::class, Mission::class);
    }

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }
    public function familly()
    {
        return $this->belongsToThrough(Familly::class, [Domain::class, Process::class, ControlPoint::class]);
    }
    public function domain()
    {
        return $this->belongsToThrough(Domain::class, [Process::class, ControlPoint::class]);
    }
    public function process()
    {
        return $this->belongsToThrough(Process::class, ControlPoint::class);
    }
    public function controlPoint()
    {
        return $this->belongsTo(ControlPoint::class);
    }

    public function dre()
    {
        return $this->belongsToThrough(Dre::class, [Agency::class, Mission::class]);
    }

    public function agency()
    {
        return $this->belongsToThrough(Agency::class, Mission::class);
    }

    public function regularization()
    {
        return $this->belongsTo(Regularization::class);
    }

    public function controller(string $type)
    {
        if ($type == 'cc') {
            return $this->belongsTo(User::class, 'assigned_to_cc_id');
        } elseif ($type == 'ci') {
            return $this->belongsTo(User::class, 'assigned_to_ci_id');
        } else {
            abort(500, "Le $type est un type inconnu.");
        }
    }

    public function dcpController()
    {
        // dd($this->controller('cc'));
        return $this->controller('cc');
    }


    /**
     * Scopes
     */
    /**
     * Get only major facts
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeOnlyMajorFacts(Builder $query)
    {
        return $query->where('major_fact', true);
    }

    /**
     * Get validated
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeValidated(Builder $query)
    {
        return $query->whereNotNull('validated_at');
    }

    /**
     * Get controlled
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeControlled(Builder $query)
    {
        return $query->whereNotNull('controlled_at')->whereNotNull('controlled_by_ci_id');
    }

    /**
     * Get uncontrolled
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeUnControlled(Builder $query)
    {
        return $query->whereNull('controlled_at')->whereNull('controlled_by_ci_id');
    }

    /**
     * Get processed
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeProcessed(Builder $query)
    {
        return $query->whereNotNull('processed_at');
    }

    /**
     * Get where has ci validation
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeHasCiValidation(Builder $query)
    {
        return $query->whereRelation('mission', 'ci_validation_at', '!=', null)->whereRelation('mission', 'ci_validation_by_id', '!=', null);
    }

    public function scopeHasCdcValidation(Builder $query)
    {
        return $query->whereRelation('mission', 'cdc_validation_at', '!=', null)->whereRelation('mission', 'cdc_validation_by_id', '!=', null);
    }

    /**
     * Get where has cdc validation
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeHasCdcrValidation(Builder $query)
    {
        return $query->whereRelation('mission', 'cdcr_validation_at', '!=', null)->whereRelation('mission', 'cdcr_validation_by_id', '!=', null);
    }

    /**
     * Get where has dcp validation
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeHasDcpValidation(Builder $query)
    {
        return $query->whereRelation('mission', 'dcp_validation_at', '!=', null)->whereRelation('mission', 'dcp_validation_by_id', '!=', null);
    }

    /**
     * Get only anomalies
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeWhereAnomaly(Builder $query)
    {
        return $query->whereIn('score', [2, 3, 4, '2', '3', '4']);
    }

    /**
     * Get details without major facts
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeWithoutMajorFacts(Builder $query)
    {
        return $query->where('major_fact', false);
    }

    /**
     * Get major facts
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeMajorFacts(Builder $query)
    {
        return $query->orWhere('major_fact', true);
    }
    /**
     * Get only validated major facts
     *
     * @param mixed $query
     *
     * @return Builder
     */
    public function scopeOnlyDispatchedMajorFacts($query)
    {
        return $query->onlyMajorFacts()->where('major_fact_dispatched_at', '!=', null);
    }

    public function scopeOnlyUnregularized($query)
    {
        return $query->whereHas('regularization', fn ($regularization) => $regularization->whereNull('regularized_at'))->orDoesntHave('regularization');
    }

    public function scopeOnlyRegularized($query)
    {
        return $query->whereHas('regularization', fn ($regularization) => $regularization->whereNotNull('regularized_at'));
    }

    public function scopeNotDispatched($query, ?string $type = null)
    {
        if ($type == 'cc') {
            return $query->whereNull('assigned_to_cc_id');
        } elseif ($type == 'ci') {
            return $query->whereNull('assigned_to_ci_id');
        } else {
            return $query->whereNull('assigned_to_cc_id')->whereNull('assigned_to_ci_id');
        }
    }

    // public function scopeWithControllers($query, ?string $type = null){

    // }

    public function scopeDispatched($query, ?string $type = null)
    {
        if ($type == 'cc') {
            return $query->whereNotNull('assigned_to_cc_id');
        } elseif ($type == 'ci') {
            return $query->whereNotNull('assigned_to_ci_id');
        } else {
            return $query->whereNotNull('assigned_to_cc_id')->whereNotNull('assigned_to_ci_id');
        }
    }
}
