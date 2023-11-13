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
    ];

    public $timestamps = false;

    protected $searchable = ['name'];

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
