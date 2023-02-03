<?php

namespace App\Filters\SampleDetails;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class DreId extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $this->query->whereRelation('dre', 'dres.id', $value);
    }
}