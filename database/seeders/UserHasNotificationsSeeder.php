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
            DB::table('user_has_notifications')->delete();

            $users = DB::table('users')->select('users.id', 'roles.code')
                ->join('roles', 'users.active_role_id', 'roles.id')->get();
            $settings = DB::table('user_has_notifications');
            $currentUser = collect([]);
            $currentType = '';
            try {
                foreach ($users as $user) {
                    $currentUser = $user;
                    if (in_array($user->code, ['ci', 'cc'])) {
                        $notificationTypes = DB::table('notification_types')->select('id')->whereIn('code', ['mission_assignation_removed', 'mission_assigned', 'mission_updated', 'mission_validated', 'mission_major_fact_rejected'])->get()->pluck('id');
                    } elseif ($user->code == 'cder') {
                        $notificationTypes = DB::table('notification_types')->select('id')->whereIn('code', ['mission_assignation_removed', 'mission_assigned'])->get()->pluck('id');
                    } elseif ($user->code == 'cdc') {
                        $notificationTypes = DB::table('notification_types')->select('id')->whereIn('code', ['control_campaign_created', 'control_campaign_deleted', 'control_campaign_updated', 'mission_major_fact_detected', 'mission_validated', 'mission_pdf_repport_generated', 'mission_major_fact_rejected'])->get()->pluck('id');
                    } elseif ($user->code == 'da') {
                        $notificationTypes = DB::table('notification_types')->select('id')->whereIn('code', ['mission_major_fact_detected', 'mission_validated', 'mission_pdf_repport_generated'])->get()->pluck('id');
                    } elseif (in_array($user->code, ['dg', 'ig', 'dga', 'sg', 'der', 'deac', 'cdrcp', 'dre', 'dcp', 'cdcr'])) {
                        $notificationTypes = DB::table('notification_types')->select('id')->whereIn('code', ['control_campaign_created', 'control_campaign_deleted', 'control_campaign_updated', 'mission_major_fact_detected', 'mission_validated', 'mission_pdf_repport_generated'])->get()->pluck('id');
                    } else if (in_array($user->code, ['cdrcp', 'dg', 'dga', 'sg', 'ig', 'deac', 'der'])) {
                        $notificationTypes = DB::table('notification_types')->select('id')->whereIn('code', ['control_campaign_created', 'mission_pdf_repport_generated', 'mission_major_fact_detected'])->get()->pluck('id');
                    } else {
                        $notificationTypes = collect([]);
                    }

                    if ($notificationTypes->isNotEmpty()) {
                        foreach ($notificationTypes as $type) {
                            $currentType = $type;
                            if (in_array($user->code, ['dg', 'ig', 'dga', 'sg', 'der', 'deac', 'cdrcp', 'dcp', 'cdcr', 'dre'])) {
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
            } catch (\Throwable $th) {
                dd($th->getMessage(), $currentUser, $currentType);
            }
        });
    }
}
