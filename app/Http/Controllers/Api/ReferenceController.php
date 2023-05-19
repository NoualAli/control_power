<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PCFResource;
use App\Models\ControlPoint;
use App\Models\Domain;
use App\Models\Familly;
use App\Models\Process;

class ReferenceController extends Controller
{
    public function pcf()
    {
        $controlPoints = ControlPoint::with(['familly', 'process', 'domain']);
        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $onlyFiltersData = request()->has('onlyFiltersData');

        if ($filter) {
            $controlPoints = $controlPoints->filter($filter);
        }

        if ($search) {
            $controlPoints = $controlPoints->search($search);
        }

        if ($sort) {
            $controlPoints = $controlPoints->sortByMultiple($sort);
        }
        // dd($controlPoints->toSql());
        if (!$onlyFiltersData) {
            $perPage = request()->has('perPage') && !empty(request()->perPage) && request()->perPage !== 'undefined' ? request()->perPage : 10;
            return PCFResource::collection($controlPoints->paginate($perPage)->onEachSide(1));
        }
        return $this->filtersData();
    }

    private function filtersData()
    {
        $famillies = formatForSelect(Familly::all()->toArray());
        $domains = formatForSelect(Domain::all()->toArray());
        $processes = formatForSelect(Process::all()->toArray());
        return compact('famillies', 'domains', 'processes');
    }
}
