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
        'domain_id'
    ];

    public $timestamps = false;

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
    public function campaign()
    {
        return $this->hasManyThrough(ControlCampaign::class, ControlCampaignProcess::class);
    }
    public function notes()
    {
        return $this->media()->whereIn('folder', ['references\Note', 'references/Note', 'uploads/references/Note']);
    }
    public function circulaires()
    {
        return $this->media()->whereIn('folder', ['references\Circulaire', 'references/Circulaire', 'uploads/references/Circulaire']);
    }
    public function lettresCirculaire()
    {
        return $this->media()->whereIn('folder', ['references\Lettre-circulaire', 'references/Lettre-circulaire', 'uploads/references/Lettre-circulaire']);
    }
    public function guidesPremierNiveau()
    {
        return $this->media()->whereIn('folder', ['references\Guide 1er niveau', 'references/Guide 1er niveau', 'uploads/references/Guide 1er niveau']);
    }
    public function others()
    {
        return $this->media()->whereIn('folder', ['references\Autre', 'references/Autre', 'uploads/references/Autre']);
    }
}
