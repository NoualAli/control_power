<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserHasNotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {

            $users = DB::table('users')->select('users.id', 'roles.code')
                ->join('roles', 'users.active_role_id', 'roles.id')->get();
            $settings = DB::table('user_has_notifications');
            $currentUser = collect([]);
            $currentType = '';
            try {
                foreach ($users as $user) {
                    $currentUser = $user;
                    if (in_array($user->code, ['ci', 'cc', 'cdc', 'ir'])) {
                        $notificationTypes = DB::table('notification_types')->select('id')->whereIn('code', ['mission_pdf_repport_generated'])->get()->pluck('id');
                        if ($notificationTypes->isNotEmpty()) {
                            foreach ($notificationTypes as $type) {
                                $currentType = $type;
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

                    if (in_array($user->code, ['cdcr', 'dcp'])) {
                        $notificationTypes = DB::table('notification_types')->select('id')->whereIn('code', ['mission_deleted'])->get()->pluck('id');
                        foreach ($notificationTypes as $type) {
                            $settings->insert([
                                'user_id' => $user->id,
                                'notification_type_id' => $type,
                                'email_is_enabled' => false,
                                'database_is_enabled' => true,
                            ]);
                        }
                    }
                }
            } catch (\Throwable $th) {
                dd($th->getMessage(), $currentUser, $currentType);
            }
        });
    }
}
