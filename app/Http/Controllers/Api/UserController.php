<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateUserInfoRequest;
use App\Http\Requests\User\UpdateUserPasswordRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Get authenticated users.
     */
    public function current()
    {
        return response()->json(auth()->user());
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        isAbleOrAbort('view_user');
        $users = new User;

        $search = request()->has('search') && !empty(request()->search) ? request()->search : null;
        $order = request()->has('order') && !empty(request()->order) ? request()->order : null;
        $filter = request()->has('filter') ? request()->filter : null;

        if ($filter) {
            $users = $users->filter($filter);
        }

        if ($order) {
            $users = $users->orderByMultiple($order);
        }
        if ($search) {
            $users = $users->search($search);
        }

        if (request()->has('fetchAll')) {
            $users = $users->get()->toArray();
        } elseif (request()->has('dre_id')) {
            $users = $users->where('dre_id', request()->dre_id)->get();
        } else {
            $perPage = request()->has('perPage') && !empty(request()->perPage) && request()->perPage !== 'undefined' ? request()->perPage : 10;
            $users = UserResource::collection($users->paginate($perPage)->onEachSide(1));
        }

        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\User\StoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            $user = User::create($data);
            if (isset($data['dres'])) {
                $dres = $data['dres'];
                unset($data['dres']);
                $user->dres()->sync($dres);
            }
            $roles = $data['roles'];
            unset($data['roles']);
            $user->roles()->sync($roles);
            return response()->json([
                'message' => CREATE_SUCCESS,
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
     * Display the specified resource.
     *
     * @param  App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        isAbleOrAbort('view_user');
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\User\UpdateUserInfoRequest  $request
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function updateInfo(UpdateUserInfoRequest $request, User $user)
    {
        try {
            $data = $request->validated();
            $roles = $data['roles'];
            $dres = $data['dres'];
            unset($data['roles']);
            unset($data['dres']);
            $user->update($data);
            $user->roles()->sync($roles);
            $user->dres()->sync($dres);
            return response()->json([
                'message' => UPDATE_SUCCESS,
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
     * Update the specified resource in storage.
     *
     * @param  App\Http\User\UpdateUserPasswordRequest  $request
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UpdateUserPasswordRequest $request, User $user)
    {
        try {
            $data = $request->validated();
            $user->password = Hash::make($data['password']);
            $user->save();
            return response()->json([
                'message' => UPDATE_PASSWORD_SUCCESS,
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
     * Remove the specified resource from storage.
     *
     * @param  App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        isAbleOrAbort('delete_user');
        try {
            $user->delete();
            return response()->json([
                'message' => DELETE_SUCCESS,
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
}