<?php

namespace App\Filters\MissionDetail;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class Familly extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $values = str_contains($value, ',') ? explode(',', $value) : $value;
        if (is_array($values)) {
            $this->query->whereRelation('familly', fn ($subquery) => $subquery->whereIn('famillies.id', $values));
        } else {
            $this->query->whereRelation('familly', 'famillies.id', $values);
        }
    }
}