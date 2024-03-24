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
                $ris = DB::table('regional_inspections')->select('code')->pluck('code')->toArray();

                $inserted = DB::table('users')->insert([
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
                        'last_name' => NULL,
                        'first_name' => NULL,
                        'username' => 'IR-144',
                        'registration_number' => NULL,
                        'email' => 'ir.alger@bna.dz',
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
                        'username' => 'IR-147',
                        'registration_number' => NULL,
                        'email' => 'ir.bejaia@bna.dz',
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
                        'last_name' => NULL,
                        'first_name' => NULL,
                        'username' => 'IR-149',
                        'registration_number' => NULL,
                        'email' => 'ir.alger149@bna.dz',
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

                DB::table('users')->insert([
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
                ]);

                DB::table('users')->insert([
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
                ]);

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
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
        });
    }
}
