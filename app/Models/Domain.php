<?php

namespace App\Models;

use App\Traits\IsSortable;
use App\Traits\IsSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Domain extends BaseModel
{
    use HasFactory, IsSearchable, IsSortable;

    protected $fillable = [
        'name',
        'family_id',
        'usable_for_agency',
        'usable_for_dre',
        'is_active',
        'display_priority',
        'creator_full_name',
    ];

    protected $searchable = ['name'];

    protected $casts = [
        'usable_for_agency' => 'boolean',
        'usable_for_dre' => 'boolean',
        'is_active' => 'boolean',
        'display_priority' => 'integer',
    ];

    // public $withCount = ['processes'];

    /**
     * Getters
     */
    /**
     * Relationships
     */
    public function family()
    {
        return $this->belongsTo(Family::class);
    }
    public function processes()
    {
        return $this->hasMany(Process::class);
    }
    public function controlPoints()
    {
        return $this->hasManyThrough(ControlPoint::class, Process::class);
    }
}
