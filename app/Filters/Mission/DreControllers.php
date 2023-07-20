<?php

namespace App\Filters\Mission;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class DreControllers extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $values = str_contains($value, ',') ? explode(',', $value) : [$value];
        $this->query->whereRelation('dreControllers', fn ($subquery) => $subquery->whereIn('users.id', $values));
    }
}
