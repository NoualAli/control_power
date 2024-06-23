<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
                print_r("  Création des utilisateurs en cours \n");
                /**
                 * Create IGA users
                 */
                DB::table('users')->insert([
                    [
                        'last_name' => NULL,
                        'first_name' => NULL,
                        'username' => 'IGA-1',
                        'registration_number' => NULL,
                        'email' => 'iga-1@bna.dz',
                        'phone' => NULL,
                        'gender' => 1,
                        'active_role_id' => 18,
                        'password' => Hash::make(config('auth.password_default')),
                        'is_active' => 1,
                        'created_at' => now(),
                        'must_change_password' => env('APP_ENV') == 'dev' ? 0 : 1,
                    ],
                    [
                        'last_name' => NULL,
                        'first_name' => NULL,
                        'username' => 'IGA-2',
                        'registration_number' => NULL,
                        'email' => 'iga-2@bna.dz',
                        'phone' => NULL,
                        'gender' => 1,
                        'active_role_id' => 18,
                        'password' => Hash::make(config('auth.password_default')),
                        'is_active' => 1,
                        'created_at' => now(),
                        'must_change_password' => env('APP_ENV') == 'dev' ? 0 : 1,
                    ]
                ]);

                $ris = DB::table('regional_inspections')->select('code')->pluck('code')->toArray();

                /**
                 * Create IR users
                 */
                DB::table('users')->insert([
                    [
                        'last_name' => NULL,
                        'first_name' => NULL,
                        'username' => 'IR-141',
                        'registration_number' => NULL,
                        'email' => 'ir.blida@bna.dz',
                        'phone' => NULL,
                        'gender' => 1,
                        'active_role_id' => 19,
                        'password' => Hash::make(config('auth.password_default')),
                        'is_active' => 1,
                        'created_at' => now(),
                        'must_change_password' => env('APP_ENV') == 'dev' ? 0 : 1,
                    ],
                    [
                        'last_name' => NULL,
                        'first_name' => NULL,
                        'username' => 'IR-142',
                        'registration_number' => NULL,
                        'email' => 'ir.constantine@bna.dz',
                        'phone' => NULL,
                        'gender' => 1,
                        'active_role_id' => 19,
                        'password' => Hash::make(config('auth.password_default')),
                        'is_active' => 1,
                        'created_at' => now(),
                        'must_change_password' => env('APP_ENV') == 'dev' ? 0 : 1,
                    ],
                    [
                        'last_name' => NULL,
                        'first_name' => NULL,
                        'username' => 'IR-143',
                        'registration_number' => NULL,
                        'email' => 'ir.oran@bna.dz',
                        'phone' => NULL,
                        'gender' => 1,
                        'active_role_id' => 19,
                        'password' => Hash::make(config('auth.password_default')),
                        'is_active' => 1,
                        'created_at' => now(),
                        'must_change_password' => env('APP_ENV') == 'dev' ? 0 : 1,
                    ],
                    [
                        'last_name' => 'BENLOUNES',
                        'first_name' => 'Samia',
                        'username' => 'IR-144',
                        'registration_number' => 3242,
                        'email' => 'ir.alger@bna.dz',
                        'phone' => '0661 92 09 75',
                        'gender' => 2,
                        'active_role_id' => 19,
                        'password' => Hash::make(config('auth.password_default')),
                        'is_active' => 1,
                        'created_at' => now(),
                        'must_change_password' => env('APP_ENV') == 'dev' ? 0 : 1,
                    ],
                    [
                        'last_name' => 'LABED',
                        'first_name' => 'NASREDDINE',
                        'username' => 'IR-147',
                        'registration_number' => 4971,
                        'email' => 'ir.bejaia@bna.dz',
                        'phone' => '0661 63 99 15',
                        'gender' => 1,
                        'active_role_id' => 19,
                        'password' => Hash::make(config('auth.password_default')),
                        'is_active' => 1,
                        'created_at' => now(),
                        'must_change_password' => env('APP_ENV') == 'dev' ? 0 : 1,
                    ],
                    [
                        'last_name' => NULL,
                        'first_name' => NULL,
                        'username' => 'IR-148',
                        'registration_number' => NULL,
                        'email' => 'ir.GrandSud@bna.dz',
                        'phone' => NULL,
                        'gender' => 1,
                        'active_role_id' => 19,
                        'password' => Hash::make(config('auth.password_default')),
                        'is_active' => 1,
                        'created_at' => now(),
                        'must_change_password' => env('APP_ENV') == 'dev' ? 0 : 1,
                    ],
                    [
                        'last_name' => 'BENABID',
                        'first_name' => 'MYRIAM',
                        'username' => 'IR-149',
                        'registration_number' => 3984,
                        'email' => 'ir.alger149@bna.dz',
                        'phone' => '0661 92 14 05',
                        'gender' => 2,
                        'active_role_id' => 19,
                        'password' => Hash::make(config('auth.password_default')),
                        'is_active' => 1,
                        'created_at' => now(),
                        'must_change_password' => env('APP_ENV') == 'dev' ? 0 : 1,
                    ],
                    [
                        'last_name' => NULL,
                        'first_name' => NULL,
                        'username' => 'IR-154',
                        'registration_number' => NULL,
                        'email' => 'ir.sidibelabbes@bna.dz',
                        'phone' => NULL,
                        'gender' => 1,
                        'active_role_id' => 19,
                        'password' => Hash::make(config('auth.password_default')),
                        'is_active' => 1,
                        'created_at' => now(),
                        'must_change_password' => env('APP_ENV') == 'dev' ? 0 : 1,
                    ],
                ]);

                foreach ($ris as $ri) {
                    $agencies = DB::table('agencies AS a')->select('a.id')
                        ->leftJoin('dres AS d', 'd.id', 'a.dre_id')
                        ->leftJoin('regional_inspections AS ri', 'ri.id', 'd.regional_inspection_id')->where('ri.code', $ri)->pluck('a.id')->toArray();
                    $user = DB::table('users')->select('id')->where('username', 'IR-' . $ri)->first()->id;

                    foreach ($agencies as $agency) {
                        DB::table('user_has_agencies')->insert(['user_id' => $user, 'agency_id' => $agency]);
                    }
                }

                /**
                 * Create department users
                 */
                $departments = DB::table('families')->select('id', 'code')->where('usable_for_dre', true)->get();
                $dre = DB::table('dres')->select('id', 'code')->get();
                foreach ($dre as $item) {
                    foreach ($departments as $department) {
                        $username = 'CD-' . $department->code . '-' . $item->code;
                        DB::table('users')->insert([
                            'last_name' => NULL,
                            'first_name' => NULL,
                            'username' => $username,
                            'registration_number' => NULL,
                            'email' => $username . '@bna.dz',
                            'phone' => NULL,
                            'gender' => 1,
                            'active_role_id' => 20,
                            'password' => Hash::make(config('auth.password_default')),
                            'is_active' => 1,
                            'created_at' => now(),
                            'must_change_password' => env('APP_ENV') == 'dev' ? 0 : 1,
                            'department_id' => $department->id,
                        ]);
                        $agencies = DB::table('agencies AS a')->select('a.id')
                            ->leftJoin('dres AS d', 'd.id', 'a.dre_id')->where('d.id', $item->id)->get()->pluck('id')->toArray();
                        $user = DB::table('users')->select('id')->where('username', $username)->first()->id;
                        foreach ($agencies as $agency) {
                            DB::table('user_has_agencies')->insert(['user_id' => $user, 'agency_id' => $agency]);
                        }
                    }
                }

                /**
                 * Add notifications to IR and IGA
                 */
                $notificationTypes = DB::table('notification_types')->select('id')->whereIn('code', ['control_campaign_created', 'control_campaign_deleted', 'control_campaign_updated', 'mission_major_fact_detected', 'mission_validated', 'mission_pdf_repport_generated'])->get()->pluck('id');
                $settings = DB::table('user_has_notifications');
                $users = DB::table('users')->where('username', 'LIKE', '%IR-%')->orWhere('username', 'LIKE', '%IGA%')->get();
                foreach ($users as $user) {
                    if ($notificationTypes->isNotEmpty()) {
                        foreach ($notificationTypes as $type) {
                            $databaseIsEnabled = true;
                            $emailIsEnabled = true;
                            $settings->insert([
                                'user_id' => $user->id,
                                'notification_type_id' => $type,
                                'email_is_enabled' => $emailIsEnabled,
                                'database_is_enabled' => $databaseIsEnabled,
                            ]);
                        }
                    }
                }

                /**
                 *  Add notifications to CD
                 */
                $notificationTypes = DB::table('notification_types')->select('id')->whereIn('code', ['mission_validated', 'mission_pdf_repport_generated'])->get()->pluck('id');
                $settings = DB::table('user_has_notifications');
                $users = DB::table('users')->where('username', 'LIKE', '%CD%')->get();
                foreach ($users as $user) {
                    if ($notificationTypes->isNotEmpty()) {
                        foreach ($notificationTypes as $type) {
                            $databaseIsEnabled = true;
                            $emailIsEnabled = true;
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
                dd($th->getMessage());
            }
        });
    }
}
