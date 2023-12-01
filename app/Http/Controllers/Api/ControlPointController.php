<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ControlPoint\StoreRequest;
use App\Http\Requests\ControlPoint\UpdateRequest;
use App\Http\Resources\ControlPointResource;
use App\Models\ControlPoint;
use App\Models\Field;
use Illuminate\Support\Arr;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use stdClass;

class ControlPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        isAbleOrAbort('view_control_point');

        $controlPoints = new ControlPoint();

        $search = request('search', null);
        $sort = request('sort', null);
        $filter = request('filter', null);
        $fetchFilters = request()->has('fetchFilters');
        $fetchAll = request('fetchAll', false);
        if ($fetchFilters) {
            return $this->filters();
        }
        if ($filter) {
            $controlPoints = $controlPoints->filter($filter);
        }

        if ($sort) {
            $controlPoints = $controlPoints->sortByMultiple($sort);
        }
        if ($search) {
            $controlPoints = $controlPoints->search($search);
        }

        $perPage = request('perPage', 10);
        $controlPoints = $fetchAll ? $controlPoints->get()->toJson() : ControlPointResource::collection($controlPoints->paginate($perPage)->onEachSide(1));
        return $controlPoints;
    }

    public function filters()
    {
        $controlPoints = new ControlPoint;
        $family = $controlPoints->relationUniqueData('family', 'name', 'id');
        $domain = $controlPoints->relationUniqueData('domain', 'name', 'id');
        $process = $controlPoints->relationUniqueData('process', 'name', 'id');

        return compact('family', 'domain', 'process');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\ControlPoint\StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $data = $request->validated();
        try {
            $controlPoint = DB::transaction(function () use ($data) {
                $data['scores'] = count($data['scores']) ? $data['scores'] : null;
                $fields = $data['sampling_fields'];
                $controlPoint = ControlPoint::create($data);
                $controlPoint->fields()->sync($fields);
                return $controlPoint;
            });
            $status = $controlPoint->wasRecentlyCreated;
            return actionResponse($status, CREATE_SUCCESS, CREATE_ERROR);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param App\Models\ControlPoint $controlPoint
     * @return JsonResponse
     */
    public function show(ControlPoint $controlPoint): JsonResponse
    {
        isAbleOrAbort('view_control_point');
        $controlPoint->load(['family', 'domain', 'process', 'fields']);
        return response()->json($controlPoint);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\ControlPoint\UpdateRequest $request
     * @param App\Models\ControlPoint $controlPoint
     *
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, ControlPoint $controlPoint): JsonResponse
    {
        try {
            $data = $request->validated();
            $status = DB::transaction(function () use ($controlPoint, $data) {
                if (is_null($controlPoint->scores) || empty($controlPoint->scores)) {
                    $data['scores'] = $data['scores'] ?: null;
                }
                $fields = $data['sampling_fields'];

                $update = $controlPoint->update($data);
                $sync = $controlPoint->fields()->sync($fields);
                return $update && $sync;
            });

            return actionResponse($status, UPDATE_SUCCESS, UPDATE_SUCCESS);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\ControlPoint $controlPoint
     * @return JsonResponse
     */
    public function destroy(ControlPoint $controlPoint): JsonResponse
    {
        isAbleOrAbort('delete_control_point');
        try {
            $status = $controlPoint->delete();
            return actionResponse($status, DELETE_SUCCESS, DELETE_ERROR);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }
}
