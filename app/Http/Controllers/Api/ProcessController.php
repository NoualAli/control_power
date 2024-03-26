<?php

namespace App\Http\Controllers\Api;

use App\Exports\ProcessesExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Process\StoreRequest;
use App\Http\Requests\Process\UpdateRequest;
use App\Http\Resources\ProcessResource;
use App\Models\ControlPoint;
use App\Models\Process;
use App\Services\ExcelExportService;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $processes = Process::with(['domain', 'family'])->withCount('control_points');
        $processes = DB::table('processes as p')
            ->select(['p.name as process', 'p.id', 'f.name as family', 'd.name as domain', DB::raw('COUNT(cp.id) as control_points_count')])
            ->leftJoin('domains as d', 'd.id', 'p.domain_id')
            ->leftJoin('families as f', 'f.id', 'd.family_id')
            ->leftJoin('control_points as cp', 'cp.process_id', 'p.id')
            ->groupBy(['p.name', 'p.id', 'f.name', 'd.name']);

        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request()->has('fetchAll');

        // $export = request('export', []);
        // $shouldExport = count($export);

        // if ($shouldExport) {
        //     return (new ExcelExportService($processes, ProcessesExport::class, 'liste_des_processus.xlsx', $export))->download();
        // }

        if ($fetchFilters) {
            return $this->filters();
        }

        if ($filter) {
            $processes = $this->filter($processes, $filter);
        }

        if ($sort) {
            $processes = $processes->sortByMultiple($sort);
        }
        if ($search) {
            $processes = $processes->search(['p.name'], $search);
        }

        $processes = $fetchAll ? $processes->get()->toJson() : ProcessResource::collection($processes->paginate($perPage)->onEachSide(1));
        return $processes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Process\StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        try {
            DB::transaction(function () use ($request) {
                $data = $request->validated();

                $process = Process::create($data);
                if (isset($data['regulations']) && !empty($data['regulations'])) {
                    $process->media()->attach($data['regulations']);
                }
            });

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
     * @param string $process
     * @return JsonResponse
     */
    public function show(string $process): JsonResponse
    {
        $processes = explode(',', $process);
        $onlyControlPoints = request()->has('onlyControlPoints');
        $data = $onlyControlPoints ? formatForSelect(ControlPoint::whereIn('process_id', $processes)->get()->toArray()) : Process::findOrFail($process)->load(['family', 'domain', 'control_points', 'media']);
        if ($data instanceof Process) {
            $data->regulations_id = $data->media->pluck('id')->toArray();
            $data->regulations = formatForSelect(getRegulations()->toArray(), 'original_name');
            $data->formatted_media = $data->media->groupBy('category');
        }
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Process\UpdateRequest $request
     * @param App\Models\Process $process
     *
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Process $process): JsonResponse
    {
        try {
            $data = $request->validated();
            if (isset($data['regulations']) && !empty($data['regulations'])) {
                $process->media()->sync($data['regulations']);
            }
            $process->update($data);
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
     * @param App\Models\Process $process
     * @return JsonResponse
     */
    public function destroy(Process $process): JsonResponse
    {
        isAbleOrAbort('delete_process');
        try {
            $process->delete();
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
