<?php

namespace App\Filters\Mission;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class Between extends QueryFilter implements FilterContract
{
    public function handle($values): void
    {
        if ($values !== ',') {
            extract($this->extractDates($values));
            $this->query->between($start, $end);
        }
    }
}
