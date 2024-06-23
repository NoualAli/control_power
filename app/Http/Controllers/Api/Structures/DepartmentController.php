<?php

namespace App\Http\Controllers\Api\Structures;

use App\Http\Controllers\Controller;
use App\Http\Resources\Structures\DepartmentResource;
use App\Http\Requests\Structures\Department\StoreRequest;
use App\Http\Requests\Structures\Department\UpdateRequest;
use App\Models\Department;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        isAbleOrAbort(['view_deparement', 'create_user', 'update_user']);
        $departments = new Department();

        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request()->has('fetchAll');

        $export = request('export', []);
        $shouldExport = count($export);

        // if ($shouldExport) {
        //     return (new ExcelExportService($departments, DresExport::class, 'liste_des_department.xlsx', $export))->download();
        // }

        if ($filter) {
            $departments = $departments->filter($filter);
        }

        if ($sort) {
            $departments = $departments->sortByMultiple($sort);
        } else {
            $departments = $departments->orderBy('code');
        }

        if ($search) {
            $departments = $departments->search($search);
        }

        if ($fetchAll) {
            $departments = formatForSelect($departments->get()->toArray(), 'full_name');
        } else {
            $departments = DepartmentResource::collection($departments->paginate($perPage)->onEachSide(1));
        }

        return $departments;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Structures\Department\StoreRequest  $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $department = Department::create($data);

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
     * @param App\Models\Structures\Department $department
     * @return JsonResponse
     */
    public function show(Department $department): JsonResponse
    {
        isAbleOrAbort('view_department');
        return response()->json($department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Requests\Structures\Department\UpdateRequest $request
     * @param App\Models\Structures\Department $department
     *
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Department $department): JsonResponse
    {
        try {
            $data = $request->validated();
            $department->update($data);
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
     * @param App\Models\Structures\Department $department
     * @return JsonResponse
     */
    public function destroy(Department $department): JsonResponse
    {
        isAbleOrAbort('delete_department');

        try {
            return actionResponse($department->delete(), DELETE_SUCCESS);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }
}