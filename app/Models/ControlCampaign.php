<?php

namespace App\Models;

use App\Traits\HasDates;
use App\Traits\HasScopes;
use App\Traits\IsFilterable;
use App\Traits\IsSortable;
use App\Traits\IsSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class ControlCampaign extends BaseModel
{
    use HasFactory, SoftDeletes, IsSearchable, IsSortable, IsFilterable, HasDates, HasRelationships, HasScopes;

    protected $fillable = [
        'description',
        'start_date',
        'end_date',
        'reference',
        'created_by_id',
        'validated_by_id',
        'validated_at',
        'validator_full_name',
    ];

    protected $appends = [
        'remaining_days_before_start',
        'remaining_days_before_end',
        'remaining_days_before_start_str',
        'remaining_days_before_end_str',
        'is_validated',
    ];

    // public $withCount = ['processes'];

    protected $searchable = ['reference'];

    protected $filter = 'App\Filters\Campaign';
    protected $filterable = ['reference'];

    /**
     * Getters
     */
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
}