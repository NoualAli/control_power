<?php

namespace App\Filters\SampleDetails;

use App\Filters\FilterContract;
use App\Filters\QueryFilter;

class SampleState extends QueryFilter implements FilterContract
{
    public function handle($value): void
    {
        if ($value == 'Régularisé') {
            // $this->query->whereRelation('sample', 'validated_at', '!=', null);
            $sign = '!=';
        } elseif ($value == 'Non régularisé') {
            $sign = '=';
            // $this->query->whereRelation('sample', 'validated_at', null);
        }
        $this->query->whereRelation('mission', 'missions.validated_at', $sign, null);
        // $this->query->where('', $value);
    }
}