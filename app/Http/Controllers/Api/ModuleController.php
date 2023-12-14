<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Module\ManageRequest;
use App\Http\Resources\ModuleResource;
use App\Models\Module;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modules = Module::with('permissions');
        $modules = ModuleResource::collection($modules->get());
        return $modules;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Module\ManageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function manage(ManageRequest $request)
    {
        try {
            $results = DB::transaction(function () use ($request) {
                $data = $request->validated();

                $role = Role::findOrFail($data['role']);

                return $role->permissions()->sync($data['permissions']);
            });

            return response()->json([
                'message' => UPDATE_SUCCESS,
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }
}
