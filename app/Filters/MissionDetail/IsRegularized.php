<?php

namespace App\Filters\MissionDetail;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class IsRegularized extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        if (boolval($value)) {
            $this->query->onlyRegularized();
        } else {
            $this->query->onlyUnregularized();
        }
    }
}
