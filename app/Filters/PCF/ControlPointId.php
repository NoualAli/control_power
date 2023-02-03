<?php

namespace App\Filters\PCF;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class ControlPointId extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $this->query->where('control_point_id', $value);
    }
}