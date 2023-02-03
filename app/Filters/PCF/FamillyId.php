<?php

namespace App\Filters\PCF;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class FamillyId extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        if ($value) {
            $this->query->whereRelation('familly', 'famillies.id', $value);
        }
    }
}