<?php

namespace App\Models;

use App\Traits\IsOrderable;
use App\Traits\IsSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Znck\Eloquent\Traits\BelongsToThrough;

class Process extends Model
{
    use HasFactory, IsSearchable, IsOrderable, BelongsToThrough;

    protected $fillable = [
        'name',
        'domain_id'
    ];

    public $timestamps = false;

    public $withCount = ['control_points'];

    public $with = ['domain', 'control_points'];

    protected $searchable = ['name'];

    /**
     * Getters
     */
    public function getProgressStatusAttribute()
    {
        $totalDetails = $this->details()->count();
        $totalFinishedDetails = $this->details->filter(fn ($detail) => $detail->score !== null)->count();
        return number_format($totalFinishedDetails * 100 / $totalDetails);
    }

    public function getAvgScoreAttribute()
    {
        return addZero(intVal($this->details->avg('score')));
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
    public function familly()
    {
        return $this->belongsToThrough(Familly::class, Domain::class);
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