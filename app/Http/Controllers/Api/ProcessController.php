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
        $processes = Process::with(['domain', 'family'])->withCount('control_points');

        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request()->has('fetchAll');

        $export = request('export', []);
        $shouldExport = count($export);

        if ($shouldExport) {
            return (new ExcelExportService($processes, ProcessesExport::class, 'liste_des_processus.xlsx', $export))->download();
        }

        if ($filter) {
            $processes = $processes->filter($filter);
        }

        if ($sort) {
            $processes = $processes->sortByMultiple($sort);
        }
        if ($search) {
            $processes = $processes->search($search);
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
                $media = $data['media'];
                unset($data['media']);
                $process = Process::create($data);
                foreach ($media as $id) {
                    $media = DB::table('has_media')->updateOrInsert([
                        'attachable_id' => $process->id,
                        'attachable_type' => Process::class,
                        'media_id' => $id,
                    ]);
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
}
