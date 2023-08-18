<?php

namespace App\Models;

use App\Traits\IsSortable;
use App\Traits\IsSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Znck\Eloquent\Traits\BelongsToThrough;

class Family extends BaseModel
{
    use HasFactory, IsSortable, IsSearchable, BelongsToThrough, HasRelationships;

    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    // public $withCount = ['domains'];

    protected $searchable = ['name'];

    /**
     * Getters
     */

    public function getNameAttribute($name)
    {
        return ucfirst(strtolower($name));
    }

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
        return $this->belongsToThrough(ControlPoint::class, [Process::class, Domain::class]);
    }

    public function details()
    {
        return $this->hasManyDeep(MissionDetail::class, [Domain::class, Process::class, ControlPoint::class]);
    }
}
