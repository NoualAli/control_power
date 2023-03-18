<?php

namespace App\Filters\Mission;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class Dre extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $values = str_contains($value, ',') ? explode(',', $value) : [$value];
        $this->query->whereRelation('dre', fn ($subquery) => $subquery->whereIn('dres.id', $values));
    }
}
