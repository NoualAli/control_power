<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserHasNotificationResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $notifications = DB::table('notification_groups')->get();
        foreach ($notifications as $group) {
            $group->notifications = DB::table('user_has_notifications as uhn')
                ->select(['nt.label', 'nt.code', 'nt.id', 'uhn.database_is_enabled', 'uhn.email_is_enabled'])
                ->join('users as u', 'u.id', 'uhn.user_id')
                ->join('notification_types as nt', 'nt.id', 'uhn.notification_type_id')
                ->where('u.id', $user->id)
                ->where('nt.notification_group_id', $group->id)
                ->get();
        }
        $notifications = $notifications->filter(fn ($group) => $group->notifications->count());
        return response()->json(UserHasNotificationResource::collection($notifications));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NotificationSetting  $notificationSetting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        try {
            return DB::transaction(function () use ($request, $user) {
                foreach ($request->all() as $key => $value) {
                    DB::table('user_has_notifications')->where('user_id', $user->id)->where('notification_type_id', $key)->update([
                        'database_is_enabled' => $value['database_is_enabled'],
                        'email_is_enabled' => $value['email_is_enabled'],
                        'updated_at' => now()->format('Y-m-d H:i:s')
                    ]);
                }

                return actionResponse(true, 'Paramètres des notifications mis à jour avec succès');
            });
        } catch (\Throwable $th) {
            return throwedError($th);
        }
    }
}
