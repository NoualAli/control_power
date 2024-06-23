<?php

namespace App\Models\Structures;

use App\Traits\IsSearchable;
use App\Traits\IsSortable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionalInspection extends Model
{
    use HasFactory, IsSearchable, IsSortable;

    protected $fillable = ['code', 'name'];

    public $timestamps = false;

    public $appends = [
        'full_name',
        'dre_str'
    ];

    protected $searchable = ['code', 'name'];

    /**
     * Getters
     */

    public function getDreStrAttribute()
    {
        return $this->dres->pluck('full_name')->implode(', ');
    }

    public function getNameAttribute($name)
    {
        return strtoupper($name);
    }

    public function getFullNameAttribute()
    {
        return $this->code . ' - ' . $this->name;
    }

    /**
     * Relationships
     */

    public function dres()
    {
        return $this->hasMany(Dre::class);
    }

    public function agencies()
    {
        return $this->hasManyThrough(Agency::class, Dre::class, 'regional_inspection_id');
    }
}
