<?php

namespace App\Filters\Campaign;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class Validated extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $value = boolval($value);
        if ($value) {
            $this->query->whereNotNull('validated_by_id');
        } else {
            $this->query->whereNull('validated_by_id');
        }
    }
}
