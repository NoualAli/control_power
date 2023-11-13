<?php

namespace App\Filters\MissionDetail;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class IsRegularized extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        if ($value == 'Levée') {
            $this->query->onlyRegularized();
        } else if ($value == 'Non levée') {
            $this->query->onlyUnregularized();
        }
    }
}
