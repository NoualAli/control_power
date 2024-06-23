<?php

namespace App\Http\Controllers\Api;

use App\Enums\EventLogTypes;
use App\Exports\UsersExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateUserInfoRequest;
use App\Http\Requests\User\UpdateUserPasswordRequest;
use App\Http\Resources\LoginHistoryResource;
use App\Http\Resources\UserResource;
use App\Models\EventLog;
use App\Models\User;
use App\Notifications\ResetUserNotification;
use App\Notifications\UserCreatedNotification;
use App\Notifications\UserPasswordUpdatedNotification;
use App\Services\ExcelExportService;
use Illuminate\Contracts\Database\Query\Builder;
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

        $filter = request('filter', null);
        $search = request('search', null);
        $sort = request('sort', null);
        $fetchFilters = request()->has('fetchFilters');
        $perPage = request('perPage', 10);
        $fetchAll = request()->has('fetchAll');
        $export = request('export', []);
        $shouldExport = count($export);

        try {
            // $users = getUsers();
            $users = User::with('roles');

            if ($fetchFilters) {
                return $this->fetchFilters();
            }


            if ($sort) {
                if (array_key_exists('full_name', $sort)) {
                    $users = $users->orderBy(DB::raw("CONCAT(first_name, ' ', last_name)"), $sort['full_name']);
                    unset($sort['full_name']);
                }
                $users = $users->sortByMultiple($sort);
            }

            if ($search) {
                $users = $users->search($search);
            }

            if ($filter) {
                $users = $this->filter($users, $filter);
            }
            if ($shouldExport) {
                return (new ExcelExportService($users, UsersExport::class, 'liste_des_utilisateurs.xlsx', $export))->download();
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
        } catch (\Throwable $th) {
            return throwedError($th);
        }
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
            $firstLoginPassword = $data['password'] ?: config('auth.password_default');
            $user = DB::transaction(function () use ($data, $firstLoginPassword) {
                $data['password'] = isset($data['password']) && !empty($data['password']) ? Hash::make($data['password'])  : Hash::make(config('auth.password_default'));
                $data['active_role_id'] = $data['role'];
                $role = $data['role'];
                unset($data['role']);
                $user = User::create($data);
                if (isset($data['structures'])) {
                    $structures = $data['structures'];
                    if ($user->role->code == 'ir') {
                        $structures = 'ri-' . $structures;
                    }
                    $agencies = loadAgencies($structures);
                    unset($data['structures']);
                    $user->agencies()->sync($agencies);
                }
                $user->roles()->attach([$role]);
                $this->setNotifications($user);
                EventLog::store(['type' => EventLogTypes::CREATE, 'attachable_type' => User::class, 'attachable_id' => $user->id]);
                if ($user->is_active) {
                    Notification::send($user, new UserCreatedNotification($user, $firstLoginPassword));
                }
                return $user;
            });
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
        return response()->json($user->load(['role', 'dres', 'agencies', 'regional_inspections', 'last_login']));
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
                $oldUser = clone $user;
                $data['active_role_id'] = $data['role'];
                $role = $data['role'];
                unset($data['role']);

                $result = $user->update($data);
                $user->roles()->attach([$role]);

                if (isset($data['structures'])) {
                    $structures = $data['structures'];
                    if ($user->role->code == 'ir') {
                        $structures = 'ri-' . $structures;
                    }
                    $structuresId = loadAgencies($structures);
                    unset($data['structures']);
                    $user->agencies()->sync($structuresId);
                }
                EventLog::store(['type' => EventLogTypes::UPDATE, 'attachable_type' => User::class, 'attachable_id' => $user->id, 'payload' => ['success' => $result, 'old' => $oldUser, 'new' => $user]]);
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
            $oldUser = clone $user;
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
            EventLog::store(['type' => EventLogTypes::RESET, 'attachable_type' => User::class, 'attachable_id' => $user->id, 'payload' => ['success' => $result, 'old' => $oldUser, 'new' => $user]]);
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
            $oldUser = clone $user;
            $result = DB::transaction(function () use ($request, $user, $oldUser) {
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
                EventLog::store(['type' => EventLogTypes::UPDATE_PASSWORD, 'attachable_type' => User::class, 'attachable_id' => $user->id, 'payload' => ['success' => $result, 'old' => $oldUser, 'new' => $user]]);
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
            $oldUser = clone $user;
            $result = $user->delete();
            EventLog::store(['type' => EventLogTypes::DELETE, 'attachable_type' => User::class, 'attachable_id' => $user->id, 'payload' => ['success' => $result, 'old' => $oldUser, 'new' => $user]]);
            return actionResponse($result, DELETE_SUCCESS, DELETE_ERROR);
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }

    /**
     * Fetch filter data to use
     *
     * @return array
     */
    private function fetchFilters(): array
    {
        $roles = DB::table('roles AS r')
            ->select('r.id', DB::raw("CONCAT(UPPER(r.code), ' - ',
            UPPER(SUBSTRING(r.name, 1, 1)) + LOWER(SUBSTRING(r.name, 2, CHARINDEX(' ', r.name + ' ', 2) - 2)) +
            CASE WHEN CHARINDEX(' ', r.name, 2) > 0 THEN ' ' + UPPER(SUBSTRING(r.name, CHARINDEX(' ', r.name, 2) + 1, 1)) + LOWER(SUBSTRING(r.name, CHARINDEX(' ', r.name, 2) + 2, LEN(r.name) - CHARINDEX(' ', r.name, 2))) ELSE '' END
            ) AS role"))
            ->rightJoin('users AS u', 'r.id', 'u.active_role_id')
            ->groupBy(['r.id', 'r.code', 'r.name'])
            ->get();

        $roles = formatForSelect($roles->toArray(), 'role');
        return compact('roles');
    }

    private function filter(Builder $users, array $filter): Builder
    {
        if (isset($filter['roles'])) {
            $roles = explode(',', $filter['roles']);
            $users = $users->whereIn('active_role_id', $roles);
        }

        if (isset($filter['is_active'])) {
            $active = $filter['is_active'] == 1 ?: 0;
            dd($active);
            $users = $users->where('is_active', $active);
        }
        // dd($users->get());
        return $users;
    }

    /**
     * Set user notifications
     */
    private function setNotifications($user)
    {
        $settings = DB::table('user_has_notifications');

        if (in_array($user->role->code, ['ci', 'cc'])) {
            $notificationTypes = DB::table('notification_types')->select('id')
                ->whereIn('code', ['mission_assignation_removed', 'mission_assigned', 'mission_updated', 'mission_validated', 'mission_major_fact_rejected']);
        } elseif ($user->code == 'cder') {
            $notificationTypes = DB::table('notification_types')->select('id')
                ->whereIn('code', ['mission_assignation_removed', 'mission_assigned']);
        } elseif ($user->role->code == 'cdc') {
            $notificationTypes = DB::table('notification_types')->select('id')
                ->whereIn('code', ['control_campaign_created', 'control_campaign_deleted', 'control_campaign_updated', 'mission_major_fact_detected', 'mission_validated', 'mission_pdf_repport_generated', 'mission_major_fact_rejected']);
        } elseif ($user->role->code == 'da') {
            $notificationTypes = DB::table('notification_types')->select('id')
                ->whereIn('code', ['mission_validated', 'mission_pdf_repport_generated']);
        } elseif (in_array($user->role->code, ['dg', 'ig', 'iga', 'ir', 'dga', 'sg', 'der', 'deac', 'cdrcp', 'dre', 'dcp', 'cdcr'])) {
            $notificationTypes = DB::table('notification_types')->select('id')
                ->whereIn('code', ['control_campaign_created', 'control_campaign_deleted', 'control_campaign_updated', 'mission_major_fact_detected', 'mission_validated', 'mission_pdf_repport_generated']);
        } elseif ($user->role->code == 'cd') {
            $notificationTypes = DB::table('notification_types')->select('id')->whereIn('code', ['mission_validated', 'mission_pdf_repport_generated']);
        } else {
            $notificationTypes = collect([]);
        }
        $notificationTypes = $notificationTypes->get();
        if ($notificationTypes->isNotEmpty()) {
            $notificationTypes = $notificationTypes->pluck('id');
            foreach ($notificationTypes as $type) {
                if (in_array($user->code, ['dg', 'ig', 'iga', 'dga', 'sg', 'der', 'deac', 'cdrcp', 'dcp', 'cdcr', 'dre'])) {
                    $databaseIsEnabled = true;
                    $emailIsEnabled = false;
                } else {
                    $databaseIsEnabled = true;
                    $emailIsEnabled = true;
                }
                $settings->insert([
                    'user_id' => $user->id,
                    'notification_type_id' => $type,
                    'email_is_enabled' => $emailIsEnabled,
                    'database_is_enabled' => $databaseIsEnabled,
                ]);
            }
        }
    }
}
