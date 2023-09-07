<?php

namespace App\Filters\MissionDetail;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class Mission extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $values = str_contains($value, ',') ? explode(',', $value) : [$value];
        $this->query->whereIn('mission_details.mission_id', $values);
    }
}
