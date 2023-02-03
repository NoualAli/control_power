<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Znck\Eloquent\Traits\BelongsToThrough;

class MissionDetail extends Model
{
    use HasFactory, SoftDeletes, HasUuid, BelongsToThrough;

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

    public $with = ['process', 'domain', 'controlPoint', 'familly'];

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
    /**
     * Relationships
     */
    public function campaign()
    {
        $this->belongsToThrough(ControlCampaign::class, Mission::class);
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
        return $this->belongsToThrough(Dre::class, [Mission::class, Agency::class]);
    }

    public function agency()
    {
        $this->belongsToThrough(Agency::class, Mission::class);
    }


    /**
     * Scopes
     */
}