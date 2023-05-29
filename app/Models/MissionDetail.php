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
        'executed_at',
        'processed_at',
        'validated_at',
        'major_fact_dispatched_at',
        'regularization_id',
    ];

    protected $filter = 'App\Filters\MissionDetail';

    protected $searchable = ['mission_details-id'];

    public $with = ['process', 'domain', 'controlPoint', 'familly', 'media'];

    public $casts = [
        'metadata' => 'object',
        'executed_at' => 'datetime:d-m-Y H:i',
        'processed_at' => 'datetime:d-m-Y H:i',
        'major_fact' => 'boolean'
    ];

    public $appends = [
        'appreciation',
        'parsed_metadata',
        'major_fact_str'
    ];

    /**
     * Getters
     */
    public function getIsRegularizedAttribute()
    {
        return $this->regularization?->regularized_at ? 'Levée' : 'Non levée';
        // return $query->whereHas('regularization', fn ($regularization) => $regularization->whereNotNull('regularized_at'));
    }
    public function getExecutedAtAttribute($executed_at)
    {
        return $executed_at ? Carbon::parse($executed_at)->format('d-m-Y H:i') : '-';
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
    public function reports()
    {
        return $this->hasMany(MissionReport::class, 'mission_id', 'mission_id');
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
     * Get mission report validated
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeDreReportValidated(Builder $query, ?string $type = 'Rapport')
    {
        return $query->whereRelation('reports', function ($report) use ($type) {
            return $report->where('type', $type)->where('validated_at', '!=', null);
        });
    }
    /**
     * Get mission report validated
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeOpinionValidated(Builder $query)
    {
        return $query->whereRelation('reports', 'mission_reports.validated_at', '!=', null);
    }

    /**
     * Get executed
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeExecuted(Builder $query)
    {
        return $query->whereNotNull('executed_at');
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

    public function scopeHasCdcValidation(Builder $query)
    {
        return $query->whereRelation('reports', function ($report) {
            return $report->where('type', 'Rapport')->where('validated_at', '!=', null);
        });
    }

    /**
     * Get where has cdcr validation
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeHasCdcrValidation(Builder $query)
    {
        return $query->whereRelation('mission', 'cdcr_validation_at', '!=', null);
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
        return $query->whereRelation('mission', 'dcp_validation_at', '!=', null);
    }

    public function scopeWhereAnomaly(Builder $query)
    {
        return $query->whereIn('score', ['2', '3', '4']);
    }

    public function scopeOnlyUnregularized($query)
    {
        return $query->whereHas('regularization', fn ($regularization) => $regularization->whereNull('regularized_at'))->orDoesntHave('regularization');
    }

    public function scopeOnlyRegularized($query)
    {
        return $query->whereHas('regularization', fn ($regularization) => $regularization->whereNotNull('regularized_at'));
    }
}
