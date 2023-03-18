<?php

namespace App\Filters\MissionDetail;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class Campaign extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $values = str_contains($value, ',') ? explode(',', $value) : $value;
        if (is_array($values)) {
            $this->query->whereRelation('campaign', fn ($subquery) => $subquery->whereIn('control_campaigns.id', $values));
        } else {
            $this->query->whereRelation('campaign', 'control_campaigns.id', $values);
        }
    }
}
