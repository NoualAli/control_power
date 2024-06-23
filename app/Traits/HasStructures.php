<?php

namespace App\Traits;

use App\Models\Structures\Agency;
use Staudenmeir\EloquentHasManyDeep\HasRelationships;
use Znck\Eloquent\Traits\BelongsToThrough;

trait HasStructures
{
    use BelongsToThrough,
        HasRelationships;
    /**
     * Getters
     */
    public function getdreStrAttribute()
    {
        return $this->dre->full_name ?: '-';
    }
    public function getdresStrAttribute()
    {
        $dres = implode(', ', $this->dres->pluck('full_name')->toArray());
        return !empty($dres) ? $dres : '-';
    }
    public function getAgenciesStrAttribute()
    {
        $agencies = implode(', ', $this->agencies->pluck('full_name')->toArray());
        return !empty($agencies) ? $agencies : '-';
    }
    public function getRegionalInspectionsStrAttribute()
    {
        $regional_inspections = implode(', ', $this->regional_inspections->pluck('full_name')->toArray());
        return !empty($regional_inspections) ? $regional_inspections : '-';
    }
    public function getAgenciesArrAttribute()
    {
        return $this->agencies?->pluck('id')->toArray();
    }
    public function getDreArrAttribute()
    {
        return $this->dres?->pluck('id')->toArray();
    }

    public function getStructuresStrAttribute()
    {
        if (hasRole(['ci', 'cdc', 'dre'], $this->role->code)) {
            return $this->dres_str;
        } elseif (hasRole('da', $this->role->code)) {
            return $this->agencies_str;
        } elseif (hasRole('ir', $this->role->code)) {
            return $this->regional_inspections_str;
        } else {
            return '-';
        }
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

    public function hasDre(int|array $dre)
    {
        if (is_array($dre)) {
            $hasDre = [];
            foreach ($dre as $item) {
                array_push($hasDre, in_array($item, $this->dre_arr));
            }
            return in_array(true, $hasDre);
        }
        return in_array($dre, $this->dre_arr);
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

    public function dre()
    {
        return $this->hasOneDeepFromRelations($this->agencies(), (new Agency())->dre())->distinct();
    }

    public function regional_inspections()
    {
        return $this->hasManyDeepFromRelations($this->agencies(), (new Agency())->regional_inspection())->distinct();
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
