<?php

namespace App\Http\Controllers;

use App\Imports\AgenciesImport;
use App\Imports\ControlPointsImport;
use App\Imports\DreImport;
use App\Imports\ReferencesImport;
use App\Imports\UsersImport;
use App\Models\Structures\Dre;
use App\Models\User;
use App\Notifications\UserCreatedNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Maatwebsite\Excel\Facades\Excel;

class ExcelReaderController extends Controller
{
    /**
     * Load references informations with their media
     *
     * @return void
     */
    public function loadReferences()
    {
        $this->resetTable('media');
        try {
            Excel::import(new ReferencesImport, public_path('data/references-list.xlsx'));
        } catch (\Throwable $th) {
            dd($th->getMessage(), $th->getLine());
        }
    }

    /**
     * Load PCF in database
     *
     * @return void
     */
    public function loadPCF()
    {
        $this->resetTable('families', true);
        try {
            Excel::import(new ControlPointsImport, public_path('data/pcf.xlsx'));
        } catch (\Throwable $th) {
            dd($th->getMessage(), $th->getLine());
        }
    }

    /**
     * Load users in database
     *
     * @return void
     */
    public function loadUsers()
    {
        // $this->resetTable('users', true);
        try {
            // $users = User::whereIn('email', ['n.khalfa@bna.dz', 'a.noual@bna.dz', 'z.benmadi@bna.dz', 'h.belloundja@bna.dz'])->orderBy('id', 'ASC')->get();
            // foreach ($users as $user) {
            //     Notification::send($user, new UserCreatedNotification($user, '123456'));
            // }
            // dd($users);
            // $user = User::where('username', 'A.NOUAL')->first();
            // for ($i = 0; $i < 10; $i++) {
            //     $user->notify(new UserCreatedNotification($user, '123456'));
            // }
            // $this->createInitialUsers();
            // Excel::import(new UsersImport, public_path('data/users.xlsx'));
            // $users = User::where('is_notified', false)->whereIn('username', ['CDC-GARIDI', 'CI-GARIDI'])->orWhereIn('active_role_id', [2, 3, 4, 7, 8, 9, 10, 12, 14])->get();
            // foreach ($users as $user) {
            //     $user->delete();
            // }
            // $this->createInitialUsers();
            // dd($users);
        } catch (\Throwable $th) {
            dd($th->getMessage(), $th->getLine());
        }
    }

    /**
     * Load DRE in database
     *
     * @return void
     */
    public function loadDre()
    {
        $this->resetTable('dres', true);
        try {
            Excel::import(new DreImport, public_path('data/dre.xlsx'));
        } catch (\Throwable $th) {
            dd($th->getMessage(), $th->getLine());
        }
    }

    /**
     * Load agencies in database
     *
     * @return void
     */
    public function loadAgencies()
    {
        $this->resetTable('agencies', true);
        try {
            Excel::import(new AgenciesImport, public_path('data/agencies.xlsx'));
        } catch (\Throwable $th) {
            dd($th->getMessage(), $th->getLine());
        }
    }

    /**
     * Load initial users in database
     *
     * @return void
     */
    private function createInitialUsers()
    {
        $mustChangePassword = true;
        $i = 1;
        // DB::unprepared('SET IDENTITY_INSERT users ON');
        // $i += 1;
        // $root = User::create([
        //     'id' => $i,
        //     'username' => 'ROOT',
        //     'first_name' => 'Ali',
        //     'last_name' => 'Noual',
        //     'email' => 'a.noual@bna.dz',
        //     'password' => Hash::make('nfc3VHYv@pc'),
        //     'active_role_id' => 1,
        //     'gender' => 1,
        //     'must_change_password' => false,
        //     'is_notified' => true,
        // ]);
        // $root->roles()->sync([1]);
        // DB::unprepared('SET IDENTITY_INSERT users OFF');

        DB::unprepared('SET IDENTITY_INSERT users ON');
        $i += 1;
        $password = $this->generatePassword();
        $cdcr = User::create([
            'id' => $i,
            'username' => 'H.BELLOUNDJA',
            'first_name' => 'Hassiba',
            'last_name' => 'Belloundja',
            'email' => 'H.BELLOUNDJA@bna.dz',
            'password' => Hash::make($password),
            'first_login_password' => $password,
            'active_role_id' => 4,
            'gender' => 2,
            'must_change_password' => $mustChangePassword
        ]);
        $cdcr->roles()->sync([4]);
        DB::unprepared('SET IDENTITY_INSERT users OFF');
        try {
            // $cdcr->notify(new UserCreatedNotification($cdcr, $password));
            Notification::send($cdcr, new UserCreatedNotification($cdcr, $password));
        } catch (\Throwable $th) {
            dd($cdcr, $th->getMessage());
        }

        DB::unprepared('SET IDENTITY_INSERT users ON');
        $i += 1;
        $password = $this->generatePassword();
        $admin = User::create([
            'id' => $i,
            'username' => 'Z.BENMADI',
            'first_name' => 'Zakarya',
            'last_name' => 'Benmadi',
            'email' => 'Z.BENMADI@bna.dz',
            'password' => Hash::make($password),
            'first_login_password' => $password,
            'active_role_id' => 7,
            'gender' => 1,
            'must_change_password' => $mustChangePassword
        ]);
        $admin->roles()->sync([7]);
        DB::unprepared('SET IDENTITY_INSERT users OFF');
        try {
            // $admin->notify(new UserCreatedNotification($admin, $password));
            Notification::send($admin, new UserCreatedNotification($admin, $password));
        } catch (\Throwable $th) {
            dd($admin, $th->getMessage());
        }

        DB::unprepared('SET IDENTITY_INSERT users ON');
        $i += 1;
        $password = $this->generatePassword();
        $dcp = User::create([
            'id' => $i,
            'first_name' => 'Chiraz',
            'last_name' => 'Bechiri',
            'username' => 'DCP',
            'email' => 'DCPermanent@bna.dz',
            'password' => Hash::make($password),
            'first_login_password' => $password,
            'active_role_id' => 3,
            'gender' => 2,
            'must_change_password' => $mustChangePassword
        ]);
        $dcp->roles()->sync([3]);
        DB::unprepared('SET IDENTITY_INSERT users OFF');
        try {
            // $dcp->notify(new UserCreatedNotification($dcp, $password));
            Notification::send($dcp, new UserCreatedNotification($dcp, $password));
        } catch (\Throwable $th) {
            dd($dcp, $th->getMessage());
        }

        DB::unprepared('SET IDENTITY_INSERT users ON');
        $i += 1;
        $password = $this->generatePassword();
        $cdrcp = User::create([
            'id' => $i,
            'first_name' => 'Fazia',
            'last_name' => 'Nait Slimane',
            'username' => 'CDRCP',
            'email' => 'DRCP@bna.dz',
            'password' => Hash::make($password),
            'first_login_password' => $password,
            'active_role_id' => 8,
            'gender' => 2,
            'must_change_password' => $mustChangePassword
        ]);
        $cdrcp->roles()->sync([8]);
        DB::unprepared('SET IDENTITY_INSERT users OFF');
        try {
            // $cdrcp->notify(new UserCreatedNotification($cdrcp, $password));
            Notification::send($cdrcp, new UserCreatedNotification($cdrcp, $password));
        } catch (\Throwable $th) {
            dd($cdrcp, $th->getMessage());
        }

        DB::unprepared('SET IDENTITY_INSERT users ON');
        $i += 1;
        $password = $this->generatePassword();
        $dg = User::create([
            'id' => $i,
            'username' => 'DG',
            'first_name' => 'Mohamed Lamine',
            'last_name' => 'Lebbou',
            'email' => 'DG@bna.dz',
            'password' => Hash::make($password),
            'first_login_password' => $password,
            'active_role_id' => 2,
            'gender' => 1,
            'must_change_password' => $mustChangePassword
        ]);
        $dg->roles()->sync([2]);
        DB::unprepared('SET IDENTITY_INSERT users OFF');
        try {
            // $dg->notify(new UserCreatedNotification($dg, $password));
            Notification::send($dg, new UserCreatedNotification($dg, $password));
        } catch (\Throwable $th) {
            dd($dg, $th->getMessage());
        }

        DB::unprepared('SET IDENTITY_INSERT users ON');
        $i += 1;
        $password = $this->generatePassword();
        $dga = User::create([
            'id' => $i,
            'username' => 'DGA',
            'first_name' => 'Brahim',
            'last_name' => 'Boudjelida',
            'email' => 'DGA@bna.dz',
            'password' => Hash::make($password),
            'first_login_password' => $password,
            'active_role_id' => 2,
            'gender' => 1,
            'must_change_password' => $mustChangePassword
        ]);
        $dga->roles()->sync([2]);
        DB::unprepared('SET IDENTITY_INSERT users OFF');
        try {
            // $dga->notify(new UserCreatedNotification($dga, $password));
            Notification::send($dga, new UserCreatedNotification($dga, $password));
        } catch (\Throwable $th) {
            dd($dga, $th->getMessage());
        }

        DB::unprepared('SET IDENTITY_INSERT users ON');
        $i += 1;
        $password = $this->generatePassword();
        $ig = User::create([
            'id' => $i,
            'username' => 'IG',
            'first_name' => 'Benhouhou',
            'last_name' => 'Hacène',
            'email' => 'IG@bna.dz',
            'password' => Hash::make($password),
            'first_login_password' => $password,
            'active_role_id' => 9,
            'gender' => 1,
            'must_change_password' => $mustChangePassword
        ]);
        $ig->roles()->sync([9]);
        DB::unprepared('SET IDENTITY_INSERT users OFF');
        try {
            // $ig->notify(new UserCreatedNotification($ig, $password));
            Notification::send($ig, new UserCreatedNotification($ig, $password));
        } catch (\Throwable $th) {
            dd($ig, $th->getMessage());
        }

        DB::unprepared('SET IDENTITY_INSERT users ON');
        $i += 1;
        $password = $this->generatePassword();
        $sg = User::create([
            'id' => $i,
            'username' => 'SG',
            'first_name' => 'Benabdi',
            'last_name' => 'Dine',
            'email' => 'SG@bna.dz',
            'password' => Hash::make($password),
            'first_login_password' => $password,
            'active_role_id' => 14,
            'gender' => 1,
            'must_change_password' => $mustChangePassword
        ]);
        $sg->roles()->sync([14]);
        DB::unprepared('SET IDENTITY_INSERT users OFF');
        try {
            // $sg->notify(new UserCreatedNotification($sg, $password));
            Notification::send($sg, new UserCreatedNotification($sg, $password));
        } catch (\Throwable $th) {
            dd($sg, $th->getMessage());
        }

        DB::unprepared('SET IDENTITY_INSERT users ON');
        $i += 1;
        $password = $this->generatePassword();
        $der = User::create([
            'id' => $i,
            'username' => 'DER',
            'first_name' => 'Halima',
            'last_name' => 'Layadi',
            'email' => 'DER@bna.dz',
            'password' => Hash::make($password),
            'first_login_password' => $password,
            'active_role_id' => 12,
            'gender' => 2,
            'must_change_password' => $mustChangePassword
        ]);
        $der->roles()->sync([12]);
        DB::unprepared('SET IDENTITY_INSERT users OFF');
        try {
            // $der->notify(new UserCreatedNotification($der, $password));
            Notification::send($der, new UserCreatedNotification($der, $password));
        } catch (\Throwable $th) {
            dd($der, $th->getMessage());
        }
    }

    /**
     * Reset specified table
     *
     * @param string $tableName
     * @param bool $resetAutoIncrement
     *
     * @return void
     */
    private function resetTable(string $tableName, bool $resetAutoIncrement = false)
    {
        DB::table($tableName)->delete();
        if ($resetAutoIncrement) {
            DB::statement('DBCC CHECKIDENT ("' . $tableName . '", RESEED, 0)');
        }
    }

    private function createUsersTest($i)
    {
        $password = '123456';
        $agencies = Dre::where('name', 'DRE GARIDI')->first()->agencies()->pluck('id')->toArray();
        DB::unprepared('SET IDENTITY_INSERT users ON');
        $i += 1;
        $cdc = User::create([
            'id' => $i,
            'username' => 'CDC-GARIDI',
            'email' => 'cdc-test@test.dz',
            'password' => Hash::make($password),
            'first_login_password' => $password,
            'active_role_id' => 5,
            'must_change_password' => false
        ]);
        $cdc->roles()->sync([5]);
        $cdc->agencies()->sync($agencies);
        DB::unprepared('SET IDENTITY_INSERT users OFF');

        DB::unprepared('SET IDENTITY_INSERT users ON');
        $i += 1;
        $ci = User::create([
            'id' => $i,
            'username' => 'CI-GARIDI',
            'email' => 'ci-test@test.dz',
            'password' => Hash::make($password),
            'first_login_password' => $password,
            'active_role_id' => 6,
            // 'must_change_password' => $mustChangePassword,
            'must_change_password' => false
        ]);
        $ci->roles()->sync([6]);
        $ci->agencies()->sync($agencies);
        DB::unprepared('SET IDENTITY_INSERT users OFF');
    }

    private function generatePassword($length = 6)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';

        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }

        // return 'Azerty123';
        return $string;
    }
}
