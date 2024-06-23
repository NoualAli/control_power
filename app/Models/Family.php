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
        'code',
        'usable_for_agency',
        'usable_for_dre',
        'is_active',
        'display_priority',
        'creator_full_name',
        'created_at',
        'updated_at',
    ];

    // public $withCount = ['domains'];

    protected $searchable = ['name'];

    protected $casts = [
        'usable_for_agency' => 'boolean',
        'usable_for_dre' => 'boolean',
        'is_active' => 'boolean',
        'display_priority' => 'integer',
    ];

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
