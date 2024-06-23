<?php

namespace App\Models;

use App\Traits\HasMedia;
use App\Traits\IsFilterable;
use App\Traits\IsSortable;
use App\Traits\IsSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Znck\Eloquent\Traits\BelongsToThrough;

class Process extends BaseModel
{
    use HasFactory, IsSearchable, IsSortable, BelongsToThrough, HasRelationships, HasMedia, IsFilterable;

    protected $filter = 'App\Filters\PCF';

    protected $fillable = [
        'name',
        'domain_id',
        'usable_for_agency',
        'usable_for_dre',
        'is_active',
        'display_priority',
        'creator_full_name',
    ];

    protected $casts = [
        'usable_for_agency' => 'boolean',
        'usable_for_dre' => 'boolean',
        'is_active' => 'boolean',
        'display_priority' => 'integer',
    ];

    // public $withCount = ['control_points'];

    // public $with = ['domain', 'control_points', 'family'];

    protected $searchable = ['name'];

    // public $appends = ['media'];

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
    public function campaigns()
    {
        return $this->hasManyThrough(ControlCampaign::class, ControlCampaignProcess::class, 'process_id', 'id', 'id', 'control_campaign_id');
    }
    public function notes()
    {
        return $this->media()->where('category', ['Note']);
    }
    public function circulaires()
    {
        return $this->media()->where('category', 'Circulaire');
    }
    public function lettresCirculaire()
    {
        return $this->media()->where('category', 'Lettre-circulaire');
    }
    public function guidesPremierNiveau()
    {
        return $this->media()->where('category', 'Guide 1er niveau');
    }
}
