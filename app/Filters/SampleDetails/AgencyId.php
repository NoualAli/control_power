<?php

namespace App\Filters\SampleDetails;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class AgencyId extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $this->query->whereRelation('agency', 'agencies.id', $value);
    }
}