<?php

namespace App\Filters\Campaign;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class Reference extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $this->query->where('control_campaigns.reference', 'LIKE', '%' . $value . '%');
    }
}