<?php

namespace App\Traits;

trait IsOrderable
{
    public function scopeOrderByMultiple($query, $sortArray)
    {
        foreach ($sortArray as $key => $value) {
            $query = $query->orderBy($key, $value);
        }
        return $query;
    }
}