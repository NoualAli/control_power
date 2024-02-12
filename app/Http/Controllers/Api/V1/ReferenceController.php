<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PCFResource;
use App\Models\Process;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class ReferenceController extends Controller
{
    public function pcf()
    {
        $processes = DB::table('processes as p')
            ->select(['p.name as process', 'p.id', 'f.name as family', 'd.name as domain'])
            ->leftJoin('domains as d', 'd.id', 'p.domain_id')
            ->leftJoin('families as f', 'f.id', 'd.family_id')
            ->groupBy(['p.name', 'p.id', 'f.name', 'd.name']);

        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request()->has('fetchAll');

        if ($fetchFilters) {
            return $this->filters();
        }

        if ($filter) {
            $processes = $this->filter($processes, $filter);
        }

        if ($search) {
            $processes = $processes->search(['p.name'], $search);
        }

        if ($sort) {
            $processes = $processes->sortByMultiple($sort);
        }

        return PCFResource::collection($processes->paginate($perPage)->onEachSide(1));
    }

    public function show(Process $process)
    {
        $process->unsetRelations();
        $process->load(['family', 'domain', 'control_points']);
        return $process->only(['family', 'domain', 'name', 'id', 'control_points']);
    }

    /**
     * Filter data
     *
     * @param Builder $processes
     * @param array $filter
     *
     * @return Builder
     */
    private function filter(Builder $processes, array $filter): Builder
    {
        if (isset($filter['family'])) {
            $families = explode(',', $filter['family']);
            $processes = $processes->whereIn('family_id', $families);
        }

        if (isset($filter['domain'])) {
            $domains = explode(',', $filter['domain']);
            $processes = $processes->whereIn('domain_id', $domains);
        }

        return $processes;
    }

    private function filters()
    {
        $filters = request('filter');
        $family = DB::table('families')->select('id', 'name');

        if (isset($filters['family'])) {
            $families = explode(',', $filters['family']);
            $domains = DB::table('domains')->select('id', 'name')->whereIn('family_id', $families);
        }

        $family = formatForSelect($family->get()->toArray());
        $domain = isset($filters['family']) ? formatForSelect($domains->get()->toArray()) : [];
        return compact('family', 'domain');
    }
}
