<?php

namespace App\Traits;

use App\Models\Agency;
use App\Models\Dre;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Znck\Eloquent\Traits\BelongsToThrough;

trait HasDres
{
    use BelongsToThrough,
        HasRelationships;
    /**
     * Getters
     */
    public function getdresStrAttribute()
    {
        $dres = implode(', ', $this->dres->pluck('name')->toArray());
        return !empty($dres) ? $dres : '-';
    }
    public function getAgenciesStrAttribute()
    {
        $agencies = implode(', ', $this->agencies->pluck('name')->toArray());
        return !empty($agencies) ? $agencies : '-';
    }
    public function getAgenciesArrAttribute()
    {
        return $this->agencies?->pluck('id')->toArray();
    }

    /**
     * Methods
     */
    public function hasAgencies(int|array $agencies)
    {
        if (is_array($agencies)) {
            $hasAgencies = [];
            foreach ($agencies as $agency) {
                array_push($hasAgencies, in_array($agency, $this->agencies_arr));
            }
            return in_array(true, $hasAgencies);
        }
        return in_array($agencies, $this->agencies_arr);
    }

    /**
     * Relationships
     */
    public function agencies()
    {
        return $this->belongsToMany(Agency::class, 'user_has_agencies', 'user_id', 'agency_id');
    }

    public function dres()
    {
        return $this->hasManyDeepFromRelations($this->agencies(), (new Agency())->dre())->distinct();
    }

    /**
     * Scopes
     */
    public function scopeWhereAgencies($query, array $agencies)
    {
        return $query->whereHas('agencies', function ($query) use ($agencies) {
            $query->whereIn('agencies.id', $agencies);
        });
    }
}