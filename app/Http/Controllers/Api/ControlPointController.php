<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ControlPoint\StoreRequest;
use App\Http\Requests\ControlPoint\UpdateRequest;
use App\Http\Resources\ControlPointResource;
use App\Models\ControlPoint;
use Illuminate\Http\JsonResponse;

class ControlPointController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $family = $controlPoints->relationUniqueData('familly', 'name', 'id');
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
            $data['scores'] = count($data['scores']) ? $data['scores'] : null;
            $data['fields'] = count($data['fields']) ? $data['fields'] : null;
            // $data['major_fact_types'] = count($data['major_fact_types']) ? $data['major_fact_types'] : null;
            $controlPoint = ControlPoint::create($data);

            return response()->json([
                'message' => CREATE_SUCCESS,
                'status' => true
            ]);
        } catch (\Throwable $th) {
            $code = 500;

            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], $code);
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
        $controlPoint->load(['familly', 'domain', 'process']);
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
            if (is_null($controlPoint->scores) || empty($controlPoint->scores)) {
                $data['scores'] = $data['scores'] ?: null;
            }
            if (is_null($controlPoint->fields) || empty($controlPoint->fields)) {
                $data['fields'] = $data['fields'] ?: null;
            }

            // if (is_null($controlPoint->major_fact_types) || empty($controlPoint->major_fact_types)) {
            //     $data['major_fact_types'] =  count($data['major_fact_types']) ? $data['major_fact_types'] : null;
            // }
            $controlPoint->update($data);
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
     * @param App\Models\ControlPoint $controlPoint
     * @return JsonResponse
     */
    public function destroy(ControlPoint $controlPoint): JsonResponse
    {
        isAbleOrAbort('delete_control_point');
        try {
            $controlPoint->delete();
            return response()->json([
                'message' => DELETE_SUCCESS,
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            $code = 500;

            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], 500);
        }
    }
}
