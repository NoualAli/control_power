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
use Illuminate\Support\Facades\DB;
use Znck\Eloquent\Traits\BelongsToThrough;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use stdClass;

class MissionDetail extends BaseModel
{
    use HasFactory, SoftDeletes, HasUuid, HasRelationships, BelongsToThrough, HasMedia, IsFilterable, IsSearchable, HasScopes;

    public $fillable = [
        'control_point_id',
        'mission_id',
        'ci_report',
        'cdc_report',
        'recovery_plan',
        'score',
        'major_fact',
        'metadata',
        'assigned_to_ci_id',
        'assigned_to_cc_id',
        'controlled_by_ci_at',
        'controlled_by_cdc_at',
        'controlled_by_cc_at',
        'controlled_by_cdcr_at',
        'controlled_by_dcp_at',
        'controlled_by_ci_id',
        'controlled_by_cdc_id',
        'controlled_by_cc_id',
        'controlled_by_cdcr_id',
        'controlled_by_dcp_id',
        'major_fact_dispatched_at',
        'regularization_id',
        'is_regularized',
        'major_fact_detected_at',
        'major_fact_dispatched_to_dcp_at',
        'cdc_full_name',
        'cdcr_full_name',
        'dcp_full_name',
    ];

    protected $filter = 'App\Filters\MissionDetail';

    protected $searchable = ['mission_details-id'];

    public $with = ['process', 'domain', 'controlPoint', 'family', 'media'];

    public $casts = [
        'metadata' => 'object',
        'controlled_by_ci_at' => 'datetime:d-m-Y H:i',
        'controlled_by_cdc_at' => 'datetime:d-m-Y H:i',
        'controlled_by_cc_at' => 'datetime:d-m-Y H:i',
        'controlled_by_cdcr_at' => 'datetime:d-m-Y H:i',
        'controlled_by_dcp_at' => 'datetime:d-m-Y H:i',
        'processed_at' => 'datetime:d-m-Y H:i',
        'major_fact_dispatched_at' => 'datetime:d-m-Y H:i',
        'major_fact' => 'boolean'
    ];

    public $appends = [
        'appreciation',
        'parsed_metadata',
        'major_fact_str',
        'score_tag',
        'report',
        'is_regularized',
        'is_regularized_str',
        'is_controlled_by_ci',
        'is_controlled_by_cdc',
        'is_controlled_by_cc',
        'is_controlled_by_cdcr',
        'is_controlled_by_dcp',
    ];

    /**
     * Getters
     */
    public function getReportAttribute()
    {
        $column = $this->cdc_report ? 'cdc_report' : 'ci_report';

        return $this->$column;
    }

    public function getIsControlledByCiAttribute()
    {
        return boolval($this->controlled_by_ci_id);
    }

    public function getIsControlledByCdcAttribute()
    {
        return boolval($this->controlled_by_cdc_id);
    }

    public function getIsControlledByCcAttribute()
    {
        return boolval($this->controlled_by_cc_id);
    }

    public function getIsControlledByCdcrAttribute()
    {
        return boolval($this->controlled_by_cdcr_id);
    }

    public function getIsControlledByDcpAttribute()
    {
        return boolval($this->controlled_by_dcp_id);
    }

    public function getIsAssignedToCcAttribute()
    {
        return boolval($this->assigned_to_cc_id);
    }

    public function getIsRegularizedAttribute()
    {
        return boolval($this->regularizations?->first()?->is_regularized);
    }

    public function getIsRegularizedStrAttribute()
    {
        return $this->is_regularized ? 'Levée' : 'Non levée';
    }

    public function getExecutedAtAttribute($controlled_by_ci_at)
    {
        return $controlled_by_ci_at ? Carbon::parse($controlled_by_ci_at)->format('d-m-Y H:i') : '-';
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

    public function getIsControlledAttribute()
    {
        return boolval($this->controlled_by_ci_at);
    }

    public function getIsDispatchedAttribute()
    {
        return boolval($this->major_fact_dispatched_at);
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

    public function getInlineMetadataAttribute()
    {
        $metadata = $this->metadata;
        $newMetadata = collect([]);
        foreach ($metadata as $rows) {
            $newRow = collect([]);
            foreach ($rows as $row) {
                unset($row->rules);
                $properties = array_keys((array) $row);
                $value = $properties[0];
                $item = new stdClass;
                $item->label = $row->label;
                $item->value = $row->$value;
                $newRow->push($item);
            }
            $newMetadata->push($newRow);
        }

        return $newMetadata;
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
    public function family()
    {
        return $this->belongsToThrough(Family::class, [Domain::class, Process::class, ControlPoint::class]);
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

    public function regularizations()
    {
        return $this->hasMany(MissionDetailRegularization::class, 'mission_detail_id')->orderBy('mission_detail_regularizations.created_at', 'DESC');
    }

    public function validatedRegularization()
    {
        return $this->belongsTo(MissionDetailRegularization::class)->where('is_regularized', true);
    }

    public function regularization()
    {
        return $this->belongsTo(MissionDetailRegularization::class);
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
    public function scopeControlled(Builder $query, string $type = 'ci')
    {
        return $query->whereNotNull('controlled_by_' . $type . '_at');
    }

    /**
     * Get uncontrolled
     *
     * @param Builder $query
     *
     * @return Builder
     */
    public function scopeUnControlled(Builder $query, string $type = 'ci')
    {
        return $query->whereNull('controlled_by_' . $type . '_at')->whereNull('controlled_by_' . $type . '_id');
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
        return $query->doesntHave('regularizations')->orWhereHas('regularizations', fn ($regularization) => $regularization->where('is_regularized', false));
    }

    public function scopeOnlyRegularized($query)
    {
        return $query->whereHas('regularizations', fn ($regularization) => $regularization->where('is_regularized', true));
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