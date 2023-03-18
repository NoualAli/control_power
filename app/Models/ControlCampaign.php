<?php

namespace App\Models;

use App\Traits\HasDates;
use App\Traits\HasScopes;
use App\Traits\IsFilterable;
use App\Traits\IsOrderable;
use App\Traits\IsSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class ControlCampaign extends Model
{
    use HasFactory, SoftDeletes, IsSearchable, IsOrderable, IsFilterable, HasDates, HasRelationships, HasScopes;

    protected $fillable = [
        'description',
        'start',
        'end',
        'reference',
        'created_by_id',
        'validated_by_id',
        'validated_at',
    ];

    protected $appends = [
        'remaining_days_before_start',
        'remaining_days_before_end',
        'remaining_days_before_start_str',
        'remaining_days_before_end_str',
    ];

    public $withCount = ['processes'];

    protected $searchable = ['reference'];

    protected $filter = 'App\Filters\Campaign';
    protected $filterable = ['reference'];

    /**
     * Setters
     */
    public static function boot()
    {
        parent::boot();

        // static::creating(function ($model) {
        //     $model->reference = generateCDCRef(false, $model->created_at);
        // });
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
        return $query->orderBy('created_at', 'ASC')->get()->last();
    }

    public function scopeValidated($query)
    {
        return $query->whereNotNull('validated_by_id');
    }
}
