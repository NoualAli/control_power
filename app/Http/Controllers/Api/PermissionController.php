<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Permission\StoreRequest;
use App\Http\Requests\Permission\UpdateRequest;
use App\Http\Resources\PermissionResource;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = new Permission();

        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request()->has('fetchAll');

        if ($filter) {
            $permissions = $permissions->filter($filter);
        }

        if ($sort) {
            $permissions = $permissions->sortByMultiple($sort);
        }
        if ($search) {
            $permissions = $permissions->search($search);
        }
        $perPage = request('perPage', 10);

        $permissions = $fetchAll ? $permissions->get()->toJson() : PermissionResource::collection($permissions->paginate($perPage)->onEachSide(1));

        return $permissions;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Permission\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validated();

            $permission = Permission::create([
                'name' => $data['name'],
            ]);
            if (isset($data['roles'])) {
                $permission->roles()->sync($data['roles']);
            }

            return response()->json([
                'message' => CREATE_SUCCESS,
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        isAbleOrAbort('view_permission');
        $permission->load('roles');
        return response()->json($permission);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Permission\UpdateRequest  $request
     * @param  App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Permission $permission)
    {
        try {
            $data = $request->validated();
            $permission->update([
                'name' => $data['name'],
            ]);

            if (isset($data['roles'])) {
                $permission->roles()->sync($data['roles']);
            }

            return response()->json([
                'message' => UPDATE_SUCCESS,
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        isAbleOrAbort('delete_permission');
        try {
            $permission->delete();
            return response()->json([
                'message' => DELETE_SUCCESS,
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
                'status' => false
            ], 500);
        }
    }
}
