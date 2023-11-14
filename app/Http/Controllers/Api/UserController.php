<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateUserInfoRequest;
use App\Http\Requests\User\UpdateUserPasswordRequest;
use App\Http\Resources\LoginHistoryResource;
use App\Http\Resources\UserResource;
use App\Models\Media;
use App\Models\User;
use App\Notifications\UserCreatedNotification;
use App\Notifications\UserInforUpdatedNotification;
use App\Notifications\UserInfoUpdatedNotification;
use App\Notifications\UserPasswordUpdatedNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Get authenticated users.
     */
    public function current()
    {
        $user = auth()->user();
        if (!hasRole(['admin', 'root'])) {
            // $missions = !hasRole(['cdcr', 'dcp', 'dg', 'ig', 'sg', 'cdrcp', 'der', 'deac', 'dga']) ? $user->missions()->with([])->get() : Mission::with([])->get();
            // $missions = getMissions()->get();
            // $missions = $missions->filter(fn ($mission) => !$mission->pdf_report_exists)->pluck('id')->toArray();
            $missions = getMissions()->get()->filter(fn ($mission) => Storage::fileExists('exported\campaigns\\' . $mission->campaign . '\\missions\\' . $mission->reference . '.pdf'));
            $user['missions_without_report'] = $missions;
        }
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
            // $users = orderByMultiple($users, $sort);
        }

        if ($search) {
            $users = $users->search($search);
            // $users = search($users, $search);
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
                $firstLoginPassword = $data['password'];
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
                if ($user->is_active) {
                    Notification::send($user, new UserCreatedNotification($user, $firstLoginPassword));
                }
            });
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

            DB::transaction(function () use ($data, $user) {
                // $keys = array_keys($data);
                // $updatedInformations = [];
                // $userCurrentInformations = $user->only([
                //     "username",
                //     "email",
                //     "first_name",
                //     "last_name",
                //     "phone",
                //     "role",
                //     "is_active",
                //     "gender",
                //     "registration_number",
                //     "agencies"
                // ]);
                // foreach ($keys as $key) {
                //     $oldValue = $userCurrentInformations[$key];
                //     $newValue = $data[$key];
                //     if ($key == 'agencies') {
                //         if (in_array($newValue, $oldValue->pluck('id')->toArray())) {
                //             $oldValue = $newValue;
                //         }
                //     }
                //     if ($key == 'role') {
                //         if ($newValue == (int) $oldValue->id) {
                //             $oldValue = $newValue;
                //         }
                //     }

                //     if ($oldValue !== $newValue) {
                //         $updatedInformations[$key] = ['oldValue' => $oldValue, 'newValue' => $newValue];
                //     }
                // }
                $data['active_role_id'] = $data['role'];
                $role = $data['role'];
                unset($data['role']);

                $user->update($data);
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
                // Notification::send($user, new UserInfoUpdatedNotification($user, $updatedInformations));
            });
            return response()->json([
                'message' => UPDATE_SUCCESS,
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
     * Update the specified resource in storage.
     *
     * @param  App\Http\User\UpdateUserPasswordRequest  $request
     * @param  App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(UpdateUserPasswordRequest $request, User $user)
    {
        try {
            return DB::transaction(function () use ($request, $user) {
                $data = $request->validated();
                $user->password = Hash::make($data['password']);
                if (auth()->user()->id !== $user->id) {
                    $user->must_change_password = true;
                }
                if ($user->save()) {
                    Notification::send($user, new UserPasswordUpdatedNotification($user, $data['password']));
                    return response()->json([
                        'message' => UPDATE_PASSWORD_SUCCESS,
                        'status' => true
                    ]);
                }
                return response()->json([
                    'message' => UPDATE_PASSWORD_ERROR,
                    'status' => false
                ]);
            });

            // return response()->json([
            //     'message' => UPDATE_PASSWORD_SUCCESS,
            //     'status' => true
            // ]);
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
        // abort_if(!hasRole('root'), 401);
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