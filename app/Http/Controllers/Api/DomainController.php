<?php

namespace App\Http\Controllers\Api;

use App\Exports\DomainsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Domains\StoreRequest;
use App\Http\Requests\Domains\UpdateRequest;
use App\Http\Resources\DomainResource;
use App\Models\Domain;
use App\Models\Process;
use App\Services\ExcelExportService;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class DomainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $domains = DB::table('domains as d')->select('d.name as domain', 'd.id', 'f.name as family', DB::raw("COUNT(p.id) as processes_count"))
            ->leftJoin('families as f', 'f.id', 'd.family_id')
            ->leftJoin('processes as p', 'd.id', 'p.domain_id')
            ->groupBy(['d.name', 'd.id', 'f.name']);

        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request()->has('fetchAll');

        $export = request('export', []);
        $shouldExport = count($export);

        if ($fetchFilters) {
            return $this->filters();
        }

        // if ($shouldExport) {
        //     return (new ExcelExportService($domains, DomainsExport::class, 'liste_des_domaines.xlsx', $export))->download();
        // }

        if ($filter) {
            $domains = $this->filter($domains, $filter);
        }

        if ($sort) {
            $domains = $domains->sortByMultiple($sort);
        }
        if ($search) {
            $domains = $domains->search(['d.name'], $search);
        }

        $domains = $fetchAll ? $domains->get()->toJson() : DomainResource::collection($domains->paginate($perPage)->onEachSide(1));
        return $domains;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Domain\StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $domain = Domain::create($data);

            return response()->json([
                'message' => CREATE_SUCCESS,
                'status' => true
            ]);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param string $domain
     * @return JsonResponse
     */
    public function show(string $domain): JsonResponse
    {
        $domains = explode(',', $domain);
        $onlyProcesses = request()->has('onlyProcesses');
        $data = $onlyProcesses ? formatForSelect(Process::whereIn('domain_id', $domains)->get()->toArray()) : Domain::findOrFail($domain)->load('family');
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Domain\UpdateRequest $request
     * @param App\Models\Domain $domain
     *
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Domain $domain): JsonResponse
    {
        try {
            $data = $request->validated();
            $domain->update($data);
            return response()->json([
                'message' => UPDATE_SUCCESS,
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\Domain $domain
     * @return JsonResponse
     */
    public function destroy(Domain $domain): JsonResponse
    {
        isAbleOrAbort('delete_domain');
        try {
            $domain->delete();
            return response()->json([
                'message' => DELETE_SUCCESS,
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * Filter data
     *
     * @param Builder $domains
     * @param array $filter
     *
     * @return Builder
     */
    private function filter(Builder $domains, array $filter): Builder
    {
        if (isset($filter['family'])) {
            $families = explode(',', $filter['family']);
            $domains = $domains->whereIn('family_id', $families);
        }

        return $domains;
    }

    private function filters()
    {
        $filters = request('filter');
        $family = DB::table('families')->select('id', 'name');
        $family = formatForSelect($family->get()->toArray());
        return compact('family');
    }
}
