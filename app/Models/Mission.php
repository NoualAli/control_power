<?php

namespace App\Models;

use App\Traits\HasDates;
use App\Traits\HasScopes;
use App\Traits\HasUuid;
use App\Traits\IsCommentable;
use App\Traits\IsFilterable;
use App\Traits\IsSortable;
use App\Traits\IsSearchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Znck\Eloquent\Traits\BelongsToThrough;

use function PHPUnit\Framework\isEmpty;

class Mission extends BaseModel
{
    use HasFactory, BelongsToThrough, HasRelationships, SoftDeletes, IsSearchable, IsSortable, HasUuid, HasDates, HasScopes, IsFilterable, IsCommentable;

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
        'reel_start',
        'reel_end',
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
        'state',
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
        'realisation_state',
        'avg_score',
        'end',
        'start',
        'has_dcp_controllers',
        'dcp_controllers_str',
        'dre_controllers_str',
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
        'total_major_facts'
    ];

    protected $casts = [
        'progress_status' => 'int',
        'programmed_start' => 'date:d-m-Y',
        'programmed_end' => 'date:d-m-Y',
        'reel_end' => 'date:d-m-Y',
        'reel_start' => 'date:d-m-Y',
        'end' => 'date:d-m-Y',
    ];

    protected $searchable = ['reference', 'campaign.reference'];

    /**
     * Getters
     */

    /**
     * @return int
     */
    public function getRemainingDaysBeforeStartAttribute(): int
    {
        $today = today();
        $startAttribute = $this->startAttribute ?? 'start';
        $start = $this->$startAttribute ? $today->diffInDays($this->$startAttribute, false) : 0;
        return $start >= 0 && $this->progress_status !== 0 ? $start : 0;
    }

    /**
     * @return string
     */
    public function getRemainingDaysBeforeEndStrAttribute(): string
    {
        $remainingDays = $this->remaining_days_before_end > 1 ? $this->remaining_days_before_end . ' jours' : $this->remaining_days_before_end . ' jour';
        return $this->remaining_days_before_end ? $remainingDays : '-';
    }

    public function getTotalAnomaliesAttribute()
    {
        return $this->details()->whereAnomaly()->count();
    }

    public function getAnomaliesRateAttribute()
    {
        $anomalies = ($this->total_anomalies * 100);
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
        return Storage::fileExists('exported\campaigns\\' . $this->campaign->reference . '\\missions\\' . $this->report_name . '.pdf');
    }

    public function getReportNameAttribute()
    {
        $reference = str_replace('/', '-', $this->reference) . '-' . str_replace(' ', '', $this->agency->name);
        return strtolower('rapport_mission-' . $reference);
    }

    public function getReportPathAttribute()
    {
        return 'exported/campaigns/' . $this->campaign->reference . '/missions/' . $this->report_name . '.pdf';
    }

    public function getEndAttribute()
    {
        $date = $this->reel_end ?: $this->programmed_end;
        return $date->format('d-m-Y');
    }

    public function getStartAttribute()
    {
        $date = $this->reel_start ?: $this->programmed_start;
        return $date->format('d-m-Y');
    }

    public function getHasDcpControllersAttribute()
    {
        return (bool) $this->dcpControllers->count();
    }
    public function getHasDreControllersAttribute()
    {
        return (bool) $this->dreControllers->count();
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

    public function getDreControllersStrAttribute()
    {
        return implode(', ', $this->dreControllers->pluck('full_name')->toArray());
    }

    public function getDcpControllersStrAttribute()
    {
        return implode(', ', $this->dcpControllers->pluck('full_name')->toArray());
    }

    public function getProgressStatusAttribute()
    {
        $totalDetails = $this->details()->count();
        $totalFinishedDetails = $this->details()->controlled()->count();

        return $totalFinishedDetails ? number_format($totalFinishedDetails * 100 / $totalDetails) : 0;
    }

    public function getRegularizationStatusAttribute()
    {
        $totalDetails = $this->details()->count();
        $totalRegularized = $this->details()->onlyRegularized()->count();

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

    public function getRealisationStateAttribute()
    {
        $today = now();
        $start = $this->programmed_start;
        $end = $this->programmed_end;
        $progressStatus = intval($this->progress_status);
        $startDiff = $today->diffInDays($start, false);
        $endDiff = $today->diffInDays($end, false);
        $totalControlled = $this->details()->controlled()->count();
        // dd($startDiff <= 0, $endDiff >= 0, $progressStatus < 100, $totalControlled);
        // dd($startDiff, $progressStatus, $totalControlled);
        if ($startDiff >= 0 && $progressStatus == 0 && !$totalControlled) {
            $state = 'À réaliser';
        } else if ($startDiff < 0 && $progressStatus == 0 && !$totalControlled) {
            $state = 'En retard';
        } else if ($startDiff <= 0 && $endDiff >= 0 && $progressStatus < 100 && $totalControlled) {
            $state = 'En cours';
        } else if ($progressStatus >= 100 && ($this->ci_report_exists && $this->is_validated_by_ci && (!$this->cdc_report_exists || ($this->cdc_report_exists && !$this->is_validated_by_cdc)) || !$this->ci_report_exists)) {
            $state = 'En attente de validation';
        } else if ($progressStatus >= 100 && $this->is_validated_by_cdc && !$this->is_validated_by_cdcr) {
            $state = 'Validé et envoyé';
        } else if ($progressStatus >= 100 && $this->is_validated_by_cdc && $this->is_validated_by_cdcr && !$this->is_validated_by_dcp) {
            $state = '1ère validation';
        } else if ($progressStatus >= 100 && $this->is_validated_by_cdc && $this->is_validated_by_dcp) {
            $state = '2ème validation';
        } else if ($endDiff < 0 && $progressStatus < 100 && (!$this->is_validated_by_ci || !$this->is_validated_by_cdc)) {
            $state = 'En retard';
        } elseif ($progressStatus && $totalControlled) {
            return 'En cours';
        } else {
            $state = 'Indéterminé';
        }
        return $state;
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
    public function controllers()
    {
        return $this->belongsToMany(User::class, 'mission_has_controllers')->withPivot('control_agency');
    }
    public function dreControllers()
    {
        return $this->belongsToMany(User::class, 'mission_has_controllers')->withPivot('control_agency');
    }

    public function dcpControllers()
    {

        return $this->hasManyThrough(User::class, MissionDetail::class, 'mission_id', 'id', 'id', 'assigned_to_cc_id')->distinct();
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
     * Check if mission has DCP controllers
     *
     * @param mixed $query
     *
     * @return Builder
     */
    public function scopeHasDcpControllers($query)
    {
        return $query->whereHas('dcpControllers');
    }

    /**
     * Check if mission has DRE controllers
     *
     * @param mixed $query
     *
     * @return Builder
     */
    public function scopeHasDreControllers($query)
    {
        return $query->whereHas('dreControllers');
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
