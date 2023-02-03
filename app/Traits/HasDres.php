<?php

namespace App\Traits;

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
    public function getAgenciesArrAttribute()
    {
        return $this->dres->pluck('agencies')->flatten()->pluck('id')->toArray();
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
    public function dres()
    {
        return $this->belongsToMany(dre::class, 'user_has_dres');
    }
}