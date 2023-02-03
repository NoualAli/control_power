<?php

namespace App\Models;

use App\Traits\IsOrderable;
use App\Traits\IsSearchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;

class Dre extends Model
{
    use HasFactory, HasRelationships, IsSearchable, IsOrderable;

    protected $fillable = [
        'name',
        'code',
    ];

    protected $perPage = 10;

    protected $searchable = ['name', 'code'];

    public $appends = [
        'agencies_count',
        'full_name',
        'agencies_str'
    ];

    public $timestamps = false;

    /**
     * Getters
     */
    public function getNameAttribute($name)
    {
        return strtoupper($name);
    }

    public function getAgenciesStrAttribute()
    {
        $agencies = implode(', ', $this->agencies->pluck('name')->flatten()->toArray());
        return !empty($agencies) ? $agencies : '-';
    }
    public function getAgenciesCountAttribute()
    {
        return $this->agencies->count();
    }

    public function getFullNameAttribute()
    {
        return $this->code . ' - ' . $this->name;
    }

    /**
     * Relationships
     */
    public function agencies()
    {
        return $this->hasMany(Agency::class);
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_has_dres');
    }
    public function detailPoints()
    {
        return $this->hasManyDeep(DetailPoint::class, [Agency::class, Sample::class, SampleDetail::class]);
    }
}