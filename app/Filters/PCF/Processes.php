<?php

namespace App\Filters\PCF;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class Processes extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $values = str_contains($value, ',') ? explode(',', $value) : [$value];
        $this->query->whereRelation('process', fn ($subquery) => $subquery->whereIn('processes.id', $values));
    }
}
