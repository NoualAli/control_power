<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateUserInfoRequest;
use App\Http\Requests\User\UpdateUserPasswordRequest;
use App\Http\Resources\LoginHistoryResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\ResetUserNotification;
use App\Notifications\UserCreatedNotification;
use App\Notifications\UserInforUpdatedNotification;
use App\Notifications\UserInfoUpdatedNotification;
use App\Notifications\UserPasswordUpdatedNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class UserController extends Controller
{
    /**
     * Get authenticated users.
     */
    public function current()
    {
        $user = auth()->user();
        $user->load('role');
        return response()->json($user);
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
        $users = User::with(['dres', 'role', 'last_login']);
        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
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
            $firstLoginPassword = $data['password'];
            $user = DB::transaction(function () use ($data) {
                $data['password'] = isset($data['password']) && !empty($data['password']) ? Hash::make($data['password'])  : Hash::make('Azerty123');
                $data['active_role_id'] = $data['role'];
                $role = $data['role'];
                unset($data['role']);
                $user = User::create($data);
                if (isset($data['agencies'])) {
                    $agencies = $data['agencies'];
                    $agencies = loadAgencies($agencies);
                    unset($data['agencies']);
                    $user->agencies()->sync($agencies);
                }
                $user->roles()->attach([$role]);
                return $user;
            });
            if ($user->is_active) {
                Notification::send($user, new UserCreatedNotification($user, $firstLoginPassword));
            }
            return response()->json([
                'message' => CREATE_SUCCESS,
                'status' => true,
            ]);
        } catch (\Throwable $th) {
            return throwedError($th);
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
        $user->unsetRelations();
        return response()->json($user->load(['role', 'dres', 'agencies', 'last_login']));
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

            $result = DB::transaction(function () use ($data, $user) {
                $data['active_role_id'] = $data['role'];
                $role = $data['role'];
                unset($data['role']);

                $result = $user->update($data);
                $user->roles()->attach([$role]);

                if (isset($data['agencies'])) {
                    $agencies = $data['agencies'];
                    $agenciesId = [];
                    if (is_array($agencies)) {
                        foreach ($agencies as $agency) {
                            array_push($agenciesId, $agency);
                        }
                    } else {
                        array_push($agenciesId, $data['agencies']);
                    }
                    unset($data['agencies']);
                    $user->agencies()->sync($agenciesId);
                }
                return $result;
                // Notification::send($user, new UserInfoUpdatedNotification($user, $updatedInformations));
            });
            return actionResponse($result, UPDATE_SUCCESS, UPDATE_ERROR);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * Reset the specified resource in storage.
     *
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function reset(User $user)
    {
        try {
            $result = DB::transaction(function () use ($user) {
                return $user->update([
                    'last_name' => null,
                    'first_name' => null,
                    'registration_number' => null,
                    'phone' => null,
                    'password' => Hash::make(config('auth.password_default')),
                    'must_change_password' => true,
                ]);
            });
            if ($result) {
                Notification::send($user, new ResetUserNotification($user));
            }
            return actionResponse($result, 'Utilisateur réinitialiser avec succès');
        } catch (\Throwable $th) {
            return throwedError($th);
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
            $result = DB::transaction(function () use ($request, $user) {
                $data = $request->validated();
                $mustChangePassword = auth()->user()->id !== $user->id;
                $result = $user->update([
                    'password' => Hash::make($data['password']),
                    'must_change_password' => $mustChangePassword,
                ]);

                if ($result) {
                    if (auth()->user()->id !== $user->id) {
                        Notification::send($user, new UserPasswordUpdatedNotification($user, $data['password']));
                    }
                }
                return $result;
            });
            return actionResponse($result, UPDATE_PASSWORD_SUCCESS, UPDATE_PASSWORD_ERROR);
        } catch (\Throwable $th) {
            return throwedError($th);
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
            $result = $user->delete();
            return actionResponse($result, DELETE_SUCCESS, DELETE_ERROR);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }
}
