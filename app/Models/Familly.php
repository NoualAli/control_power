<?php

namespace App\Models;

use App\Traits\IsOrderable;
use App\Traits\IsSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Znck\Eloquent\Traits\BelongsToThrough;

class Familly extends Model
{
    use HasFactory, IsOrderable, IsSearchable, BelongsToThrough;

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    // public $withCount = ['domains'];

    protected $searchable = ['name'];

    /**
     * Getters
     */

    /**
     * Relationships
     */
    public function domains()
    {
        return $this->hasMany(Domain::class);
    }

    public function processes()
    {
        return $this->hasManyThrough(Process::class, Domain::class);
    }

    public function controlPoints()
    {
        return $this->belongsToThrough(ControlPoint::class, [Domain::class, Process::class]);
    }

    public function details()
    {
        return $this->belongsToThrough(MissionDetail::class, [Domain::class, Process::class, ControlPoint::class]);
    }
}
