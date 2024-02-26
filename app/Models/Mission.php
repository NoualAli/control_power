<?php

namespace App\Models;

use App\Traits\HasDates;
use App\Traits\HasMedia;
use App\Traits\HasScopes;
use App\Traits\HasUuid;
use App\Traits\IsCommentable;
use App\Traits\IsFilterable;
use App\Traits\IsSortable;
use App\Traits\IsSearchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Znck\Eloquent\Traits\BelongsToThrough;
use Illuminate\Support\Str;

class Mission extends BaseModel
{
    use HasFactory, BelongsToThrough, HasRelationships, SoftDeletes, IsSearchable, IsSortable, HasUuid, HasDates, HasScopes, IsFilterable, IsCommentable, HasMedia;

    protected $filter = 'App\Filters\Mission';

    protected $startAttribute = 'programmed_start';
    protected $endAttribute = 'programmed_end';

    protected $fillable = [
        'reference',
        'control_campaign_id',
        'agency_id',
        'created_by_id',
        'controlled_by_id',
        'note',
        'programmed_start',
        'programmed_end',
        'real_start',
        'real_end',
        'ci_validation_by_id',
        'cdc_validation_by_id',
        'cc_validation_by_id',
        'cdcr_validation_by_id',
        'dcp_validation_by_id',
        'da_validation_by_id',
        'ci_validation_at',
        'cdc_validation_at',
        'cc_validation_at',
        'cdcr_validation_at',
        'dcp_validation_at',
        'da_validation_at',
        'current_state',
        'creator_full_name',
        'cdc_validator_full_name',
        'cdcr_validator_full_name',
        'dcp_validator_full_name',
        'da_validator_full_name',
        'is_for_testing',
        'assigned_to_cc_id',
        'assigned_to_ci_id',
        'assigned_to_cder_id',
        'assigned_to_cder_at',
    ];

    protected $hidden = [
        'dcp_validation_by_id', 'cdcr_validation_by_id', 'cdc_validation_by_id', 'ci_validation_by_id', 'cc_validation_by_id', 'da_validation_by_id'
    ];

    protected $appends = [
        'remaining_days_before_start',
        'remaining_days_before_end',
        'remaining_days_before_start_str',
        'remaining_days_before_end_str',
        'progress_status',
        'regularization_status',
        'avg_score',
        'end',
        'start',
        'is_validated_by_ci',
        'is_validated_by_cdc',
        'is_validated_by_cc',
        'is_validated_by_cdcr',
        'is_validated_by_dcp',
        'is_validated_by_da',
        'ci_report_exists',
        'cdc_report_exists',
        'ci_report',
        'cdc_report',
        'pdf_report_exists',
        'report_name',
        'total_anomalies',
        'anomalies_rate',
        'total_details',
        'has_major_facts',
        'total_major_facts',
        'is_late',
        'report_link',
        'is_for_testing_str',
        'assistants_str',
    ];

    protected $casts = [
        'progress_status' => 'int',
        'programmed_start' => 'date:d-m-Y',
        'programmed_end' => 'date:d-m-Y',
        'real_end' => 'date:d-m-Y',
        'real_start' => 'date:d-m-Y',
        'end' => 'date:d-m-Y',
    ];

    protected $searchable = ['reference', 'campaign.reference'];

    /**
     * Getters
     */
    public function getAssistantsStrAttribute()
    {
        return $this->assistants->pluck('id')->map(fn ($assistant) => normalizeFullName(getUserFullNameWithRole($assistant)))->join(', ');
    }

    public function getIsForTestingStrAttribute()
    {
        return $this->is_for_testing ? 'Oui' : 'Non';
    }
    public function getIsLateAttribute()
    {
        $programmedStart = Carbon::parse($this->programmed_start);
        $realEnd = $this->real_end ?: Carbon::parse($this->real_end);
        $cdcValidationAt = $this->cdc_validation_at ? Carbon::parse($this->cdc_validation_at) : null;
        $ciValidationAt = $this->ci_validation_at ? Carbon::parse($this->ci_validation_at) : null;
        // $dcpValidationAt = $this->dcp_validation_at ? Carbon::parse($this->dcp_validation_at) : null;
        // $daValidationAt = $this->da_validation_at ? Carbon::parse($this->da_validation_at) : null;
        $isLate = false;

        if (hasRole('ci')) {
            $diffInWeek = $programmedStart->diffInWeeks($realEnd, false);
            $difference = $programmedStart->diffInDays($realEnd, false);

            if ($diffInWeek) {
                $difference = $difference + ($diffInWeek * 2);
            }
            $isLate = $difference > 15;
        } elseif (hasRole('cdc')) {
            $diffInWeek = $programmedStart->diffInWeeks($realEnd, false);
            $difference = $programmedStart->diffInDays($realEnd, false);

            if ($diffInWeek) {
                $difference = $difference + ($diffInWeek * 2);
            }

            // Include comparison with cdc_validation_at
            $isLate = $difference > 15 || ($cdcValidationAt && $cdcValidationAt->diffInDays($realEnd, false) > 15) || ($ciValidationAt && $ciValidationAt->diffInDays($realEnd, false) > 15);
        } else {
            // if ($daValidationAt && $dcpValidationAt) {
            //     $daValidationAt = $daValidationAt->diffInDays($dcpValidationAt, false);
            // } else if ($dcpValidationAt && !$daValidationAt) {
            //     $daValidationAt = $dcpValidationAt->diffInDays(today(), false);
            // } else {
            //     $daValidationAt = 0;
            // }
            $isLate = $programmedStart->diffInDays($realEnd, false) > 15;
        }
        // dd($isLate);
        return $isLate;
    }



    /**
     * @return int
     */
    public function getRemainingDaysBeforeStartAttribute(): int
    {
        $today = today();
        $startAttribute = $this->startAttribute;
        $start = $this->$startAttribute ? $today->diffInDays($this->$startAttribute, false) : 0;
        return $start >= 0 ? $start : 0;
    }


    /**
     * @return int
     */
    public function getRemainingDaysBeforeEndAttribute(): int
    {
        $today = today();
        $endAttribute = $this->endAttribute ?? 'end';
        $realEnd = $this->real_end;
        if ($realEnd) {
            $endAttribute = 'real_end';
        }
        $end = $this->$endAttribute ? $today->diffInDays($this->$endAttribute, false) : 0;
        return $end >= 0 ? $end : 0;
    }

    /**
     * @return string
     */
    public function getRemainingDaysBeforeEndStrAttribute(): string
    {
        return daysRemainingStr($this->remaining_days_before_end);
        // $remainingDays = $this->remaining_days_before_end > 1 ? $this->remaining_days_before_end . ' jours' : $this->remaining_days_before_end . ' jour';
        // return $this->remaining_days_before_end ? ' / ' . $remainingDays : '';
    }

    public function getTotalAnomaliesAttribute()
    {
        return $this->details()->whereAnomaly()->count() + $this->total_major_facts;
    }

    public function getAnomaliesRateAttribute()
    {
        $anomalies = (($this->total_anomalies) * 100);
        return $anomalies ? number_format($anomalies  / $this->total_details, 2) : 0;
    }

    public function getTotalDetailsAttribute()
    {
        return $this->details()->count();
    }

    public function getHasMajorFactsAttribute()
    {
        return (bool) $this->total_major_facts;
    }

    public function getTotalMajorFactsAttribute()
    {
        return $this->details()->onlyMajorFacts()->count();
    }

    public function getPdfReportExistsAttribute()
    {
        return Storage::fileExists('public\exported\campaigns\\' . $this->campaign->reference . '\\missions\\' . $this->report_name . '.pdf');
    }

    public function getReportNameAttribute()
    {
        $reference = Str::slug($this->reference . '-' . $this->agency->name);
        return strtolower('rapport_mission-' . $reference);
    }

    public function getReportLinkAttribute()
    {
        return env('APP_URL') . '/storage/exported/campaigns/' . $this->campaign->reference . '/missions/' . $this->report_name . '.pdf';
    }

    public function getEndAttribute()
    {
        $date = $this->real_end ?: $this->programmed_end;
        return $date->format('d-m-Y');
    }

    public function getStartAttribute()
    {
        $date = $this->real_start ?: $this->programmed_start;
        return $date->format('d-m-Y');
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
    }

    public function getDreControllerStrAttribute()
    {
        return $this->dreController->full_name;
    }

    public function getProgressStatusAttribute()
    {
        $totalDetails = $this->details()->count();
        $totalFinishedDetails = $this->details()->controlled()->count();

        return $totalFinishedDetails ? number_format($totalFinishedDetails * 100 / $totalDetails) : 0;
    }

    public function getRegularizationStatusAttribute()
    {
        $totalDetails = $this->details()->whereAnomaly()->count();
        $totalRegularized = $this->details()->onlyRegularized()->count();
        // dd($totalDetails, $totalRegularized);
        return $totalRegularized ? number_format($totalRegularized * 100 / $totalDetails) : 0;
    }

    public function getCiReportExistsAttribute()
    {
        return boolval($this->ci_report);
    }

    public function getCdcReportExistsAttribute()
    {
        return boolval($this->cdc_report);
    }

    public function getCdcrValidationAtAttribute($cdcr_validation_at)
    {
        return $cdcr_validation_at ? Carbon::parse($cdcr_validation_at)->format('d-m-Y') : null;
    }

    public function getDcpValidationAtAttribute($dcp_validation_at)
    {
        return $dcp_validation_at ? Carbon::parse($dcp_validation_at)->format('d-m-Y') : null;
    }

    public function getCiValidationAtAttribute($ci_validation_at)
    {
        return $ci_validation_at ? Carbon::parse($ci_validation_at)->format('d-m-Y') : null;
    }

    public function getCdcValidationAtAttribute($cdc_validation_at)
    {
        return $cdc_validation_at ? Carbon::parse($cdc_validation_at)->format('d-m-Y') : null;
    }

    public function getCcValidationAtAttribute($cc_validation_at)
    {
        return $cc_validation_at ? Carbon::parse($cc_validation_at)->format('d-m-Y') : null;
    }

    public function getDaValidationAtAttribute($da_validation_at)
    {
        return $da_validation_at ? Carbon::parse($da_validation_at)->format('d-m-Y') : null;
    }


    public function getIsValidatedByCiAttribute()
    {
        return boolval($this->ci_validation_at) && boolval($this->ci_validation_by_id);
    }

    public function getIsValidatedByCdcAttribute()
    {
        return boolval($this->cdc_validation_at) && boolval($this->cdc_validation_by_id);
    }

    public function getIsValidatedByCcAttribute()
    {
        return boolval($this->cc_validation_at) && boolval($this->cc_validation_by_id);
    }

    public function getIsValidatedByCdcrAttribute()
    {
        return boolval($this->cdcr_validation_at) && boolval($this->cdcr_validation_by_id);
    }

    public function getIsValidatedByDcpAttribute()
    {
        return boolval($this->dcp_validation_at) && boolval($this->dcp_validation_by_id);
    }

    public function getIsValidatedByDaAttribute()
    {
        return boolval($this->da_validation_at) && boolval($this->dcp_validation_by_id);
    }

    public function getCdcReportAttribute()
    {
        return $this->comments()->where('type', 'cdc_report')->first();
    }

    public function getCiReportAttribute()
    {
        return $this->comments()->where('type', 'ci_report')->first();
    }

    /**
     * Relationships
     */
    public function assistants()
    {
        return $this->belongsToMany(User::class, 'mission_has_controllers', 'mission_id', 'user_id');
    }

    public function dreController()
    {
        return $this->belongsTo(User::class, 'assigned_to_ci_id');
    }

    public function dcpController()
    {

        return $this->hasOne(User::class, 'assigned_to_cc_id');
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
        return $this->hasMany(MissionDetail::class)->where('is_disabled', false);
    }

    public function ciValidator()
    {
        return $this->belongsTo(User::class, 'ci_validation_by_id');
    }
    public function cdcValidator()
    {
        return $this->belongsTo(User::class, 'cdc_validation_by_id');
    }

    public function ccValidator()
    {
        return $this->belongsTo(User::class, 'cc_validation_by_id');
    }
    public function cdcrValidator()
    {
        return $this->belongsTo(User::class, 'cdcr_validation_by_id');
    }

    public function dcpValidator()
    {
        return $this->belongsTo(User::class, 'dcp_validation_by_id');
    }

    public function daRegularizator()
    {
        return $this->belongsTo(User::class, 'da_validation_by_id');
    }

    public function missionOrder()
    {
        return $this->media()->where(function ($query) {
            $query->whereLike('folder', '%uploads/Ordres de mission%')->orWhere('folder', 'uploads/mission_order');
        });
    }

    public function closingReport()
    {
        return $this->media()->where(function ($query) {
            $query->whereLike('folder', '%uploads/Pv de clôture%')->orWhere('folder', 'uploads/closing_report');
        });
    }


    /**
     * Scopes
     */

    /**
     * Check if mission has controllers
     *
     * @param mixed $query
     *
     * @return Builder
     */
    public function scopeHasControllers($query)
    {
        return $query->whereHas('controllers');
    }

    /**
     * Check if mission is validated by CDCR
     *
     * @param mixed $query
     *
     * @return Builder
     */
    public function scopeHasCdcrValidation($query)
    {
        return $query->whereNotNull('cdcr_validation_at');
    }

    /**
     * Check if mission is validated by DCP
     *
     * @param mixed $query
     *
     * @return Builder
     */
    public function scopeHasDcpValidation($query)
    {
        return $query->whereNotNull('dcp_validation_at');
    }

    /**
     * Check if mission is validated by CDC
     *
     * @param mixed $query
     *
     * @return Builder
     */
    public function scopeHasCdcValidation($query)
    {
        return $query->whereNotNull('cdc_validation_at');
    }

    /**
     * Check if mission is validated by CC
     *
     * @param mixed $query
     *
     * @return Builder
     */
    public function scopeHasCcValidation($query)
    {
        return $query->whereNotNull('cc_validation_at');
    }

    /**
     * Check if mission is validated by CI
     *
     * @param mixed $query
     *
     * @return Builder
     */
    public function scopeHasCiValidation($query)
    {
        return $query->whereNotNull('ci_validation_at');
    }


    /**
     * Get mission executed by DRE controller
     *
     * @param mixed $query
     *
     * @return Builder
     */
    public function scopeExecuted($query)
    {
        return $query->whereRelation('reports', 'type', 'Avis contrôleur', '!=', null)->whereRelation('reports', 'validated_at', '!=', null);
    }


    /**
     * Get missions validated by CDC
     *
     * @param mixed $query
     *
     * @return Builder
     */
    public function scopeValidated($query)
    {
        return $query->whereRelation('reports', 'type', 'Rapport', '!=', null)->whereRelation('reports', 'validated_at', '!=', null);
    }

    public function scopeIsForTesting(Builder $query)
    {
        return $query->where('is_for_testing', true);
    }
    public function scopeIsNotForTesting(Builder $query)
    {
        return $query->where('is_for_testing', false);
    }

    /**
     * Methods
     */

    /**
     * Fetch not yet dispatched processes
     *
     * @return array
     */
    public function notDispatchedProcesses(?string $concerned = null)
    {
        $notDispatchedProcesses = $this->details()->notDispatched($concerned)->without(['family', 'domain', 'controlPoint', 'media'])->with(['process' => fn ($process) => $process->pluck('processes.id', 'processes.name')->toArray()])->get()->pluck('process');
        $notDispatchedProcesses = getMissionProcesses($this)->get()->filter(function ($item) use ($notDispatchedProcesses) {
            $notDispatchedProcesses = array_unique($notDispatchedProcesses->pluck('id')->toArray());
            return in_array($item->process_id, $notDispatchedProcesses);
        })->pluck('process_id')->map(fn ($process) => intval($process))->toArray();

        $pcf = recursive_collect(getPcf());
        $filteredCollection = $pcf->map(function ($family) use ($notDispatchedProcesses) {
            $family['checkable'] = false;
            $family['children'] = $family['children']->filter(function ($domain) use ($notDispatchedProcesses) {
                $domain['children'] = $domain['children']->filter(function ($process) use ($notDispatchedProcesses) {
                    return in_array($process['id'], $notDispatchedProcesses);
                });

                return count($domain['children']) > 0;
            });

            return $family;
        })->filter(function ($item) {
            return count($item['children']) > 0;
        });

        return recursivelyToArray($filteredCollection->values());
    }
}
