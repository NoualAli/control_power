<?php

namespace App\Models;

use App\Traits\HasDates;
use App\Traits\HasMedia;
use App\Traits\HasScopes;
use App\Traits\HasUuid;
use App\Traits\IsFilterable;
use App\Traits\IsSortable;
use App\Traits\IsSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class ControlCampaign extends BaseModel
{
    use HasFactory, HasUuid, IsSearchable, IsSortable, IsFilterable, HasDates, HasRelationships, HasScopes, HasMedia;

    protected $fillable = [
        'description',
        'start_date',
        'end_date',
        'reference',
        'created_by_id',
        'validated_by_id',
        'validated_at',
        'validator_full_name',
        'creator_full_name',
        'is_for_testing',
    ];

    protected $appends = [
        'remaining_days_before_start',
        'remaining_days_before_end',
        'remaining_days_before_start_str',
        'remaining_days_before_end_str',
        'is_validated',
        'is_for_testing_str',
    ];

    /**
     * @var array
     */
    protected $searchable = ['reference'];

    /**
     * @var string
     */
    protected $filter = 'App\Filters\Campaign';

    /**
     * @var array
     */
    protected $filterable = ['reference'];

    protected $startAttribute = 'start_date';
    protected $endAttribute = 'end_date';

    /**
     * Getters
     */
    public function getIsForTestingStrAttribute()
    {
        return $this->is_for_testing ? 'Oui' : 'Non';
    }
    public function getStartDateAttribute($start_date)
    {
        return \Carbon\Carbon::parse($start_date)->format('d-m-Y');
    }

    public function getEndDateAttribute($end_date)
    {
        return \Carbon\Carbon::parse($end_date)->format('d-m-Y');
    }

    public function getIsValidatedAttribute()
    {
        return boolval($this->validated_at) && boolval($this->validated_by_id);
    }

    /**
     * Relationships
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by_id');
    }

    public function controllers()
    {
        return $this->hasManyDeepFromRelations($this->missions(), (new Mission())->controllers());
    }

    public function missions()
    {
        return $this->hasMany(Mission::class, 'control_campaign_id');
    }

    public function details()
    {
        return $this->hasManyThrough(MissionDetail::class, Mission::class);
    }

    public function processes()
    {
        return $this->belongsToMany(Process::class, 'control_campaign_processes');
    }

    public function synthesis()
    {
        return $this->media()->where('folder', 'Synthèses');
    }

    /**
     * Scopes
     */
    public function scopeCurrent($query)
    {
        return $query->validated()->orderBy('created_at', 'ASC')->get()->last();
    }

    public function scopeValidated($query)
    {
        return $query->whereNotNull('validated_by_id');
    }

    public function scopeIsForTesting($query)
    {
        return $query->where('is_for_testing', true);
    }

    public function scopeIsNotForTesting($query)
    {
        return $query->where('is_for_testing', false);
    }
}
