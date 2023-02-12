<?php

namespace App\Models;

use App\Traits\HasMedia;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Znck\Eloquent\Traits\BelongsToThrough;

class MissionDetail extends Model
{
    use HasFactory, SoftDeletes, HasUuid, BelongsToThrough, HasMedia;

    public $fillable = [
        'control_point_id',
        'mission_id',
        'report',
        'recovery_plan',
        'score',
        'major_fact',
        'metadata',
        'validated_at',
        'executed_at'
    ];

    public $with = ['process', 'domain', 'controlPoint', 'familly', 'media'];

    public $casts = [
        'metadata' => 'object'
    ];

    public $appends = [
        'appreciation',
        'parsed_metadata'
    ];

    /**
     * Getters
     */
    public function getAppreciationAttribute()
    {
        $score = collect($this->controlPoint->scores)->filter(fn ($score) => $score[0]->score == $this->score)->first();
        return isset($score[1]) ? $score[1]->label : null;
    }

    public function getParsedMetadataAttribute()
    {
        return collect($this->metadata)->flatten()->groupBy('label')->map(function ($data) {
            return collect($data)->map(function ($item) {
                $item = collect($item);
                $values = $item->values()->map(fn ($value, $index) => $index == 1 ? $value : null)->filter(fn ($item) => $item)->flatten();
                return $values;
            });
        });
    }
    public function getMajorFactStrAttribute()
    {
        return $this->major_fact ? '<i class="las la-check-circle text-success text-medium" title="Oui"></i>' : '<i class="las la-times-circle text-danger text-medium" title="Non"></i>';
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
    public function familly()
    {
        return $this->belongsToThrough(Familly::class, [Domain::class, Process::class, ControlPoint::class]);
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


    /**
     * Scopes
     */
    public function scopeExecuted($query)
    {
        return $query->where('executed_at', '!=', null);
    }
}