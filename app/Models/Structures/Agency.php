<?php

namespace App\Models\Structures;

use App\Models\AgencyHasExceptionalProcess;
use App\Models\BaseModel;
use App\Models\Mission;
use App\Models\MissionDetail;
use App\Models\Process;
use App\Models\User;
use App\Traits\IsSortable;
use App\Traits\IsSearchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Agency extends BaseModel
{
    use HasFactory, IsSearchable, IsSortable;

    protected $fillable = [
        'name',
        'code',
        'dre_id',
        'category_id',
        'is_for_testing',
    ];

    protected $perPage = 10;

    public $timestamps = false;

    protected $searchable = ['name', 'code'];

    protected $appends = [
        'full_name',
        'is_for_testing_str'
    ];

    /**
     * Getters
     */
    public function getIsForTestingStrAttribute()
    {
        return $this->is_for_testing ? 'Oui' : 'Non';
    }
    public function getFullNameAttribute()
    {
        return $this->code . ' - ' . $this->name;
    }

    /**
     * Relationships
     */
    public function dre()
    {
        return $this->belongsTo(Dre::class, 'dre_id');
    }

    public function regional_inspection()
    {
        return $this->hasOneThrough(RegionalInspection::class, Dre::class, 'id', 'id', 'dre_id', 'regional_inspection_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_has_agencies', 'agency_id', 'user_id');
    }

    public function missions()
    {
        return $this->hasMany(Mission::class);
    }

    public function details()
    {
        return $this->hasManyThrough(MissionDetail::class, Mission::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function processes()
    {
        return $this->belongsToMany(Process::class, AgencyHasExceptionalProcess::class);
    }

    public function usableProcesses()
    {
        return $this->processes()->wherePivot('is_usable', true);
    }
    public function unusableProcesses()
    {
        return $this->processes()->wherePivot('is_usable', false);
    }

    /**
     * Scopes
     */
    public function scopeIsForTesting(Builder $query)
    {
        return $query->where('is_for_testing', true);
    }
    public function scopeIsNotForTesting(Builder $query)
    {
        return $query->where('is_for_testing', false);
    }
}
