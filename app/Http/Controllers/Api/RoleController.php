<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        isAbleOrAbort(['view_role', 'create_user', 'update_user']);
        $roles = new Role();
        $search = request()->has('search') && !empty(request()->search) ? request()->search : null;
        $order = request()->has('order') && !empty(request()->order) ? request()->order : null;

        if ($order) {
            $roles = $roles->orderByMultiple($order);
        }
        if ($search) {
            $roles = $roles->search($search);
        }

        $roles = request()->has('fetchAll') ? $roles->get()->toJson() : RoleResource::collection($roles->paginate()->onEachSide(1));
        return $roles;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Role\StoreRequest  $request*
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $role = Role::create([
                'name' => $data['name'],
                'code' => $data['code'],
                'guard_name' => Auth::getDefaultDriver()
            ]);
            $role->permissions()->sync($data['permissions']);

            return response()->json([
                'message' => CREATE_SUCCESS,
                'status' => true
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
     * @param App\Models\Role $role
     * @return JsonResponse
     */
    public function show(Role $role): JsonResponse
    {
        isAbleOrAbort('view_role');
        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param App\Http\Role\UpdateRequest $request
     * @param App\Models\Role $role
     *
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Role $role): JsonResponse
    {
        try {
            $data = $request->validated();
            $role->update([
                'name' => $data['name'],
                'guard_name' => Auth::getDefaultDriver()
            ]);

            $role->permissions()->sync($data['permissions']);
            return response()->json([
                'message' => UPDATE_SUCCESS,
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
     * Remove the specified resource from storage.
     *
     * @param App\Models\Role $role
     * @return JsonResponse
     */
    public function destroy(Role $role): JsonResponse
    {
        isAbleOrAbort('delete_role');
        try {
            $role->delete();
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