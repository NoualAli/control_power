<?php

namespace App\Filters\SampleDetails;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class Score extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $this->query->where('score', $value);
    }
}