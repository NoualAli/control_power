<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PCFResource;
use App\Models\ControlPoint;
use App\Models\Domain;
use App\Models\Family;
use App\Models\Process;

class ReferenceController extends Controller
{
    public function pcf()
    {
        $controlPoints = ControlPoint::with(['family', 'process', 'domain']);

        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request()->has('fetchAll');

        if ($fetchFilters) {
            return $this->filtersData();
        }

        if ($filter) {
            $controlPoints = $controlPoints->filter($filter);
        }

        if ($search) {
            $controlPoints = $controlPoints->search($search);
        }

        if ($sort) {
            $controlPoints = $controlPoints->sortByMultiple($sort);
        }

        return PCFResource::collection($controlPoints->paginate($perPage)->onEachSide(1));
    }

    public function show(ControlPoint $controlPoint)
    {
        $controlPoint->unsetRelations();
        $controlPoint->load(['family', 'domain', 'process']);
        return $controlPoint->only(['family', 'domain', 'process', 'name', 'id']);
    }

    private function filtersData()
    {
        // dd(request()->all());
        $filters = request('filter', false);
        $families = $filters ? $filters?->family : false;
        $domains = $filters ? $filters->domain : false;

        $family = formatForSelect(Family::all()->toArray());

        $domain = formatForSelect(Domain::all()->toArray());
        $process = formatForSelect(Process::all()->toArray());
        return compact('family', 'domain', 'process');
    }
}
