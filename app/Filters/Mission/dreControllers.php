<?php

namespace App\Filters\Mission;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class dreControllers extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $this->query->where('', $value);
    }
}
