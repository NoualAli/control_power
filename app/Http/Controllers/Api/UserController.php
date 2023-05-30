<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateUserInfoRequest;
use App\Http\Requests\User\UpdateUserPasswordRequest;
use App\Http\Resources\LoginHistoryResource;
use App\Http\Resources\UserResource;
use App\Models\Dre;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Get authenticated users.
     */
    public function current()
    {
        return response()->json(auth()->user());
    }

    public function loginsHistory()
    {
        return LoginHistoryResource::collection(paginate(auth()->user()->logins()->orderBy('created_at', 'DESC')->orderBy('last_activity', 'DESC')->get(), '/api/logins/history'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        isAbleOrAbort('view_user');
        $users = User::with(['dres', 'roles']);

        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        // $fetchAll = request()->has('fetchAll');
        $fetchAll = request()->has('fetchAll');

        if ($filter) {
            $users = $users->filter($filter);
        }

        if ($sort) {
            $users = $users->sortByMultiple($sort);
        }
        if ($search) {
            $users = $users->search($search);
        }

        if ($fetchAll) {
            $users = formatForSelect($users->get()->toArray(), 'full_name');
        } elseif (request()->has('dre_id')) {
            $users = $users->where('dre_id', request()->dre_id)->get();
        } else {
            $perPage = request('perPage', 10);
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
            DB::transaction(function () use ($data) {
                $data['password'] = isset($data['password']) && !empty($data['password']) ? Hash::make($data['password'])  : Hash::make('Azerty123');
                $user = User::create($data);
                if (isset($data['dres'])) {
                    $dres = $data['dres'];
                    $agencies = $this->loadAgencies($dres);
                    unset($data['dres']);
                    $user->agencies()->sync($agencies);
                }
                $roles = $data['roles'];
                unset($data['roles']);
                $user->roles()->sync($roles);
            });
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
        return response()->json($user->load('agencies'));
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
            DB::transaction(function () use ($data, $user) {
                $roles = $data['roles'];
                unset($data['roles']);

                $user->update($data);
                $user->roles()->sync($roles);

                if (isset($data['dres'])) {
                    $dres = $data['dres'];
                    $agencies = $this->loadAgencies($dres);
                    unset($data['dres']);
                    $user->agencies()->sync($agencies);
                }
            });
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

    private function loadAgencies(array $data)
    {
        $data = Arr::flatten(array_map(function ($item) {
            $item = explode('-', $item);
            $ids = [];
            if ($item[0] == 'd') {
                $ids = array_merge(Dre::findOrFail($item[1])->agencies->pluck('id')->toArray(), $ids);
            } else {
                $ids = array_merge($ids, [intval($item[0])]);
            }
            return $ids;
        }, $data));
        $data = Validator::make($data, [
            '*' => 'exists:agencies,id'
        ])->validated();
        return $data;
    }
}
