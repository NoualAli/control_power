<?php

namespace App\Filters\User;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class RolesCodes extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        $this->query->whereRelation('roles', 'roles.code', $value);
    }
}
