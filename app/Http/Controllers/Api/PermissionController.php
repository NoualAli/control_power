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
        $search = request()->has('search') && !empty(request()->search) ? request()->search : null;
        $order = request()->has('order') && !empty(request()->order) ? request()->order : null;

        if ($order) {
            $permissions = $permissions->orderByMultiple($order);
        }
        if ($search) {
            $permissions = $permissions->search($search);
        }
        $permissions = request()->has('fetchAll') ? $permissions->get()->toJson() : PermissionResource::collection($permissions->paginate()->onEachSide(1));

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
                'guard_name' => Auth::getDefaultDriver()
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
            ]);
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
                'guard_name' => Auth::getDefaultDriver()
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
                'status' => false,
            ]);
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
            ]);
        }
    }
}