<?php

namespace App\Models;

use App\Traits\IsSortable;
use App\Traits\IsSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Dre extends BaseModel
{
    use HasFactory, HasRelationships, IsSearchable, IsSortable;

    protected $fillable = [
        'name',
        'code',
    ];

    protected $perPage = 10;

    protected $searchable = ['name', 'code'];

    public $appends = [
        'full_name',
        // 'agencies_str'
    ];

    public $timestamps = false;

    // public $with = ['agencies'];

    /**
     * Getters
     */
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
}
