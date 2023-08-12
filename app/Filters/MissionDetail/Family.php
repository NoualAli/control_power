<?php

namespace App\Filters\MissionDetail;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class Family extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $values = str_contains($value, ',') ? explode(',', $value) : $value;
        if (is_array($values)) {
            $this->query->whereRelation('family', fn ($subquery) => $subquery->whereIn('families.id', $values));
        } else {
            $this->query->whereRelation('family', 'families.id', $values);
        }
    }
}
