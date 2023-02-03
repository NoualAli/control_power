<?php

namespace App\Filters\PCF;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class ProcessId extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        if ($value) {
            $this->query->whereRelation('process', 'processes.id', $value);
        }
    }
}