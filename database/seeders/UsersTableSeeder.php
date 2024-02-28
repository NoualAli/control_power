<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Notifications\UpdateUsernamesNotification;
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
                $inserted = DB::table('users')->insert([
                    [
                        'last_name' => 'OUKID',
                        'first_name' => 'OUARDIA',
                        'username' => 'O.OUKID',
                        'registration_number' => '10347',
                        'email' => 'O.OUKIDOuardia@bna.dz',
                        'phone' => '0795451425',
                        'gender' => 2,
                        'active_role_id' => 17,
                        'password' => Hash::make('Azerty123'),
                        'is_active' => 1,
                        'created_at' => now(),
                        'must_change_password' => env('APP_ENV') == 'dev' ? 0 : 1,
                    ],
                    [
                        'last_name' => 'HADJOUMEUR',
                        'first_name' => 'REDA',
                        'username' => 'R.HADJOUMEUR',
                        'email' => 'R.HADJOUMEUR@bna.dz',
                        'registration_number' => '11974',
                        'phone' => NULL,
                        'gender' => 1,
                        'active_role_id' => 17,
                        'password' => Hash::make('Azerty123'),
                        'is_active' => 1,
                        'created_at' => now(),
                        'must_change_password' => env('APP_ENV') == 'dev' ? 0 : 1,
                    ],
                    [
                        'last_name' => 'ASSOUANE',
                        'first_name' => 'ASSIA',
                        'username' => 'A.ASSOUANE',
                        'registration_number' => '10527',
                        'email' => 'A.MAKHLOUF@bna.dz',
                        'phone' => NULL,
                        'gender' => 2,
                        'active_role_id' => 17,
                        'password' => Hash::make('Azerty123'),
                        'is_active' => 1,
                        'created_at' => now(),
                        'must_change_password' => env('APP_ENV') == 'dev' ? 0 : 1,
                    ],
                    [
                        'last_name' => 'SEDDIKI',
                        'first_name' => 'KHEIRA',
                        'username' => 'K.SEDDIKI',
                        'registration_number' => '3757',
                        'email' => 'K.SEDDIKI@bna.dz',
                        'phone' => NULL,
                        'gender' => 2,
                        'active_role_id' => 17,
                        'password' => Hash::make('Azerty123'),
                        'is_active' => 1,
                        'created_at' => now(),
                        'must_change_password' => env('APP_ENV') == 'dev' ? 0 : 1,
                    ],
                    [
                        'last_name' => 'MERDJI',
                        'first_name' => 'ISMA',
                        'username' => 'I.MERDJI',
                        'registration_number' => '10305',
                        'email' => 'I.MERDJI@bna.dz',
                        'phone' => NULL,
                        'gender' => 2,
                        'active_role_id' => 17,
                        'password' => Hash::make('Azerty123'),
                        'is_active' => 1,
                        'created_at' => now(),
                        'must_change_password' => env('APP_ENV') == 'dev' ? 0 : 1,
                    ],
                    [
                        'last_name' => 'DJERRAD',
                        'first_name' => 'HOUDA',
                        'username' => 'H.DJERRAD',
                        'registration_number' => '10172',
                        'email' => 'H.DJERAD@bna.dz',
                        'phone' => NULL,
                        'gender' => 2,
                        'active_role_id' => 17,
                        'password' => Hash::make('Azerty123'),
                        'is_active' => 1,
                        'created_at' => now(),
                        'must_change_password' => env('APP_ENV') == 'dev' ? 0 : 1,
                    ],
                    [
                        'last_name' => 'KHELIOUENE',
                        'first_name' => 'REDOUANE',
                        'username' => 'R.KHELIOUENE',
                        'registration_number' => '10997',
                        'email' => 'R.KHELIOUEN@bna.dz',
                        'phone' => NULL,
                        'gender' => 1,
                        'active_role_id' => 17,
                        'password' => Hash::make('Azerty123'),
                        'is_active' => 1,
                        'created_at' => now(),
                        'must_change_password' => env('APP_ENV') == 'dev' ? 0 : 1,
                    ],
                    [
                        'last_name' => 'LATRECHE',
                        'first_name' => 'SAAD',
                        'username' => 'S.LATRECHE',
                        'registration_number' => '11388',
                        'email' => 'S.LATRECHE@bna.dz',
                        'phone' => NULL,
                        'gender' => 1,
                        'active_role_id' => 17,
                        'password' => Hash::make('Azerty123'),
                        'is_active' => 1,
                        'created_at' => now(),
                        'must_change_password' => env('APP_ENV') == 'dev' ? 0 : 1,
                    ],
                    [
                        'last_name' => 'DEBBAGHI',
                        'first_name' => 'SALIMA',
                        'username' => 'S.DEBBAGHI',
                        'registration_number' => '14854',
                        'email' => 'S.DEBBAGHI@bna.dz',
                        'phone' => NULL,
                        'gender' => 2,
                        'active_role_id' => 17,
                        'password' => Hash::make('Azerty123'),
                        'is_active' => 1,
                        'created_at' => now(),
                        'must_change_password' => env('APP_ENV') == 'dev' ? 0 : 1,
                    ],
                    [
                        'last_name' => 'CHIKHI',
                        'first_name' => 'HANANE',
                        'username' => 'H.CHIKHI',
                        'registration_number' => '14850',
                        'email' => 'H.CHIKHI@bna.dz',
                        'phone' => NULL,
                        'gender' => 1,
                        'active_role_id' => 17,
                        'password' => Hash::make('Azerty123'),
                        'is_active' => 1,
                        'created_at' => now(),
                        'must_change_password' => env('APP_ENV') == 'dev' ? 0 : 1,
                    ],
                ]);
                if ($inserted) {
                    print_r("  Création des utilisateurs terminer avec succès ! \n");
                } else {
                    print_r("  Création des utilisateurs terminer avec des erreurs \n");
                }
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
        });
    }
}
