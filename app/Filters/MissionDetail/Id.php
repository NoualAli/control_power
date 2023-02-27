<?php

namespace App\Filters\MissionDetail;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class Id extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $this->query->where('', $value);
    }
}
