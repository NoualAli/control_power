<?php

namespace Database\Seeders;

use App\Models\User;
use App\Notifications\UpdateUsernamesNotification;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            try {
                $roles = DB::table('roles')->whereIn('code', ['da', 'cdc', 'dre'])->get();
                $updated = 0;
                foreach ($roles as $role) {
                    $currentRole = $role;
                    $users = collect([]);
                    if ($role->code == 'da') {
                        $users = DB::table('users as u')
                            ->select([DB::raw("CONCAT('DA-',a.code) as new_username"), 'username', 'u.id'])
                            ->join('user_has_agencies as uha', 'u.id', 'uha.user_id')
                            ->join('agencies as a', 'a.id', 'uha.agency_id')
                            ->where('active_role_id', $role->id)
                            ->groupBy(['a.code', 'username', 'u.id'])
                            ->get();
                    } elseif ($role->code == 'cdc') {
                        $users = DB::table('users as u')
                            ->select([DB::raw("CONCAT('CDC-',d.code) as new_username"), 'username', 'u.id'])
                            ->join('user_has_agencies as uha', 'u.id', 'uha.user_id')
                            ->join('agencies as a', 'a.id', 'uha.agency_id')
                            ->join('dres as d', 'd.id', 'a.dre_id')
                            ->where('active_role_id', $role->id)
                            ->groupBy(['d.code', 'username', 'u.id'])
                            ->get();
                    } elseif ($role->code == 'dre') {
                        $users = DB::table('users as u')
                            ->select([DB::raw("CONCAT('DRE-',d.code) as new_username"), 'username', 'u.id'])
                            ->join('user_has_agencies as uha', 'u.id', 'uha.user_id')
                            ->join('agencies as a', 'a.id', 'uha.agency_id')
                            ->join('dres as d', 'd.id', 'a.dre_id')
                            ->where('active_role_id', $role->id)
                            ->groupBy(['d.code', 'username', 'u.id'])
                            ->get();
                    }
                    foreach ($users as $user) {
                        $currentUser = $user;
                        $result = DB::table('users')->where('id', $user->id)->update([
                            'username' => $user->new_username
                        ]);
                        Notification::send(User::findOrFail($user->id), new UpdateUsernamesNotification($role, $user));
                        if ($result) {
                            $updated += 1;
                        }
                    }
                }
                print_r('Total utilisateurs mis à jour: ' . $updated . '\n');
            } catch (\Throwable $th) {
                dd($th->getMessage(), $currentRole, $currentUser);
            }
        });
    }
}
