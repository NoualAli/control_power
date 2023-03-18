<?php

namespace App\Filters\Mission;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class Campaign extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $values = str_contains($value, ',') ? explode(',', $value) : [$value];
        $this->query->whereRelation('campaign', fn ($subquery) => $subquery->whereIn('control_campaigns.id', $values));
    }
}
