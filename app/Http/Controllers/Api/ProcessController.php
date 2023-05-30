<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Process\StoreRequest;
use App\Http\Requests\Process\UpdateRequest;
use App\Http\Resources\ProcessResource;
use App\Models\ControlPoint;
use App\Models\Process;
use Illuminate\Http\JsonResponse;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $processes = Process::with(['domain', 'familly'])->withCount('control_points');

        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request()->has('fetchAll');

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
            $data = $request->validated();
            $process = Process::create($data);

            return response()->json([
                'message' => CREATE_SUCCESS,
                'status' => true
            ]);
        } catch (\Throwable $th) {
            $code = $th->getCode() ?: 500;

            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], $code);
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
        $data = $onlyControlPoints ? formatForSelect(ControlPoint::whereIn('process_id', $processes)->get()->toArray()) : Process::findOrFail($process)->load(['familly', 'domain', 'control_points']);
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
            $code = $th->getCode() ?: 500;

            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], $code);
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
            $code = $th->getCode() ?: 500;

            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], $code);
        }
    }
}
