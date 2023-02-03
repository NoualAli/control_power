<?php

namespace App\Filters\SampleDetails;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class DomainId extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        if ($value) {
            $this->query->whereRelation('domain', 'domains.id', $value);
        }
    }
}