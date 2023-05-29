<?php

namespace App\Models;

use App\Traits\HasDates;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\SoftDeletes;

class MissionReport extends BaseModel
{
    use HasFactory, SoftDeletes, HasUuid, HasDates;

    protected $fillable = [
        'type',
        'content',
        'mission_id',
        'created_by_id',
        'validated_at',
    ];

    public $appends = ['is_validated'];

    public $casts = [
        'validated_at' => 'datetime: d-m-Y H:i'
    ];

    /**
     * Getters
     */
    public function getIsValidatedAttribute()
    {
        return $this->validated_at ? true : false;
    }

    /**
     * Relationships
     */
    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    public function detail()
    {
        return $this->belongsTo(MissionDetail::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
