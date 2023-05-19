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

        $search = request('search', null);
        $sort = request('sort', null);
        $filter = request('filter', null);

        if ($filter) {
            $roles = $roles->filter($filter);
        }

        if ($sort) {
            $roles = $roles->sortByMultiple($sort);
        }
        if ($search) {
            $roles = $roles->search($search);
        }
        $perPage = request()->has('perPage') && !empty(request()->perPage) && request()->perPage !== 'undefined' ? request()->perPage : 10;
        $roles = request()->has('fetchAll') ? formatForSelect($roles->get()->toArray(), 'full_name') : RoleResource::collection($roles->paginate($perPage)->onEachSide(1));
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
                'code' => $data['code']
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
            ], 500);
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
                'code' => $data['code']
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
            ], 500);
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
            ], 500);
        }
    }
}
