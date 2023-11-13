<?php

namespace App\Imports;

use App\Models\Agency;
use App\Models\Dre;
use App\Models\Role;
use App\Models\User;
use App\Notifications\UserCreatedNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            DB::transaction(function ()  use ($row) {
                $role = Role::where('name', $row['role'])->first();
                $first_name = (string) strtoupper(trim($row['prenom'], " \t\n\r\0\x0B\u{A0}"));
                $last_name = (string) strtoupper(trim($row['nom'], " \t\n\r\0\x0B\u{A0}"));
                $username = substr(str_replace(' ', '', $first_name), 0, 1) . '.' . str_replace(' ', '', $last_name);
                $email = !empty($row['adresse_email']) ? (string) trim($row['adresse_email'], " \t\n\r\0\x0B\u{A0}") : null;
                $phone = (string) trim($row['n_de_telephone']);
                $phone = !\Str::startsWith(trim($phone, " \t\n\r\0\x0B\u{A0}"), '0') ? '0' . trim($phone) : $phone;
                $agencies = !empty($row['indice_agence']) && !empty($row['agence']) ?
                    Agency::where('name', trim($row['agence']))->where('code', $row['indice_agence'])->get()->pluck('id') :
                    Dre::where('name', trim($row['dre']))->where('code', $row['indice_dre'])->first()?->agencies?->pluck('id');
                $password = $this->generatePassword();


                if ($role) {
                    $user = [
                        'username' => $username,
                        'first_name' => $first_name,
                        'last_name' => $last_name,
                        'gender' => trim($row['genre']) == 'Homme' ? 1 : 2,
                        'email' => $email,
                        'phone' => $phone,
                        'active_post' => (string) trim($row['poste']),
                        'active_role_id' => $role->id,
                        'is_active' => true,
                        'must_change_password' => true,
                        'password' => Hash::make($password),
                        'first_login_password' => $password,
                        'is_notified' => false
                    ];

                    $userExists = User::where('first_name', $user['first_name'])->where('last_name', $user['last_name'])->count();
                    // if ($userExists !== null) {
                    //     $userExists->delete();
                    // }
                    if (!$userExists && !empty($first_name) && !empty($last_name)) {
                        $user = User::create($user);
                        $user->roles()->attach([$role->id]);
                        $user->agencies()->sync($agencies);
                        try {
                            if ($user->username !== 'ROOT') {
                                // Notification::send($user, new UserCreatedNotification($user, $password));
                                $user->notify(new UserCreatedNotification($user, $password));
                                $user->update(['is_notified' => true]);
                            }
                        } catch (\Throwable $th) {
                            dd($user, $th->getMessage());
                        }
                    }
                }
            });
        } catch (\Throwable $th) {
            dd($th->getMessage(), $th->getLine(), $row);
        }
    }

    private function generatePassword($length = 6)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        return $string;
    }
}
