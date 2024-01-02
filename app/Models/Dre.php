<?php

namespace App\Models;

use App\Traits\IsSortable;
use App\Traits\IsSearchable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Dre extends BaseModel
{
    use HasFactory, HasRelationships, IsSearchable, IsSortable;

    protected $fillable = [
        'name',
        'code',
        'is_for_testing',
    ];

    protected $perPage = 10;

    protected $searchable = ['name', 'code'];

    public $appends = [
        'full_name',
        'is_for_testing_str'
    ];

    public $timestamps = false;


    /**
     * Getters
     */
    public function getIsForTestingStrAttribute()
    {
        return $this->is_for_testing ? 'Oui' : 'Non';
    }

    public function getNameAttribute($name)
    {
        return strtoupper($name);
    }

    // public function getAgenciesStrAttribute()
    // {
    //     $agencies = implode(', ', $this->agencies->pluck('name')->flatten()->toArray());
    //     return !empty($agencies) ? $agencies : '-';
    // }

    public function getFullNameAttribute()
    {
        return $this->code . ' - ' . $this->name;
    }

    /**
     * Relationships
     */
    // Define the many-to-many relationship with User through UserHasAgency pivot table
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_has_agencies', 'agency_id', 'user_id');
    }

    // Define the one-to-many relationship with Agency
    public function agencies()
    {
        return $this->hasMany(Agency::class);
    }

    public function missions()
    {
        return $this->hasManyThrough(Mission::class, Agency::class);
    }

    public function details()
    {
        return $this->hasManyDeep(MissionDetail::class, [Agency::class, Mission::class]);
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
