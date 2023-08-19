<?php

namespace App\Models;

use App\Traits\HasMedia;
use App\Traits\IsSortable;
use App\Traits\IsSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Znck\Eloquent\Traits\BelongsToThrough;

class Process extends BaseModel
{
    use HasFactory, IsSearchable, IsSortable, BelongsToThrough, HasRelationships, HasMedia;

    protected $fillable = [
        'name',
        'domain_id'
    ];

    public $timestamps = false;

    // public $withCount = ['control_points'];

    // public $with = ['domain', 'control_points', 'family'];

    protected $searchable = ['name'];

    /**
     * Getters
     */
    public function getTagAttribute()
    {
        return '<span class="tag">' . $this->name . '</span>';
    }

    /**
     * Relationships
     */
    public function domain()
    {
        return $this->belongsTo(Domain::class);
    }
    public function control_points()
    {
        return $this->hasMany(ControlPoint::class);
    }
    public function family()
    {
        return $this->belongsToThrough(Family::class, Domain::class);
    }
    public function details()
    {
        return $this->hasManyThrough(MissionDetail::class, ControlPoint::class);
    }
    public function campaign()
    {
        return $this->hasManyThrough(ControlCampaign::class, ControlCampaignProcess::class);
    }
}
