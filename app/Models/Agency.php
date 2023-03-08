<?php

namespace App\Models;

use App\Traits\IsOrderable;
use App\Traits\IsSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agency extends Model
{
    use HasFactory, IsSearchable, IsOrderable;

    protected $fillable = [
        'name',
        'code',
        'dre_id',
    ];

    protected $perPage = 10;

    public $timestamps = false;

    protected $searchable = ['name', 'code'];

    protected $appends = [
        'full_name'
    ];

    /**
     * Getters
     */
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
}
