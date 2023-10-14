<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateUserInfoRequest;
use App\Http\Requests\User\UpdateUserPasswordRequest;
use App\Http\Resources\LoginHistoryResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Notifications\UserCreatedNotification;
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
            // $missions = !hasRole(['cdcr', 'dcp', 'dg', 'ig', 'sg', 'cdrcp', 'der']) ? $user->missions()->with([])->get() : Mission::with([])->get();
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
        $users = User::with(['dres', 'role']);

        // $users = DB::table('users as u')
        //     ->select([
        //         'u.id',
        //         'u.username',
        //         DB::raw('CONCAT(u.last_name, " ", u.first_name) AS full_name'),
        //         'u.email',
        //         'u.is_active',
        //         'r.name as r_name',
        //         'r.code as r_code',
        //         'dres',
        //     ])
        //     ->leftJoin('roles as r', 'r.id', '=', 'u.active_role_id')
        //     ->leftJoin(DB::raw('(SELECT uha.user_id, GROUP_CONCAT(DISTINCT CONCAT(d.code, " - ", d.name) ORDER BY d.code ASC SEPARATOR ", ") AS dres
        // FROM user_has_agencies as uha
        // LEFT JOIN agencies as a ON a.id = uha.agency_id
        // LEFT JOIN dres as d ON d.id = a.dre_id
        // GROUP BY uha.user_id) as dres'), 'dres.user_id', '=', 'u.id');
        // dd($users->get());
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
        return response()->json($user->load(['role', 'dres', 'agencies']));
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
                $data['active_role_id'] = $data['role'];
                $role = $data['role'];
                unset($data['role']);

                $user->update($data);
                $user->roles()->attach([$role]);

                if (isset($data['agencies'])) {
                    $agencies = $data['agencies'];
                    $agencies = loadAgencies($agencies);
                    unset($data['agencies']);
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
            if (auth()->user()->id !== $user->id) {
                $user->must_change_password = true;
            }
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
        abort_if(!hasRole('root'), 401);
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
