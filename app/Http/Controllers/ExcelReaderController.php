<?php

namespace App\Http\Controllers;

use App\Imports\ControlPointsImport;
use App\Imports\DocImport;
use App\Imports\ReferencesImport;
use App\Models\Agency;
use App\Models\Dre;
use App\Models\User;
use DragonCode\Support\Facades\Helpers\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ExcelReaderController extends Controller
{
    public function loadReferences()
    {
        $media = DB::table('media')->where('extension', 'docx')->delete();
        try {
            // Excel::import(new ReferencesImport, public_path('references-list.xlsx'));
            Excel::import(new DocImport, public_path('references-list (2).xlsx'));
        } catch (\Throwable $th) {
            dd($th->getMessage(), $th->getLine());
        }
    }

    public function loadPCF()
    {
        Excel::import(new ControlPointsImport, public_path('pcf.xlsx'));
    }

    public function createUsers()
    {

        $password = Hash::make('123456');
        $mustChangePassword = false;
        $i = 0;

        DB::unprepared('SET IDENTITY_INSERT users ON');
        $i += 1;
        $root = User::create([
            'id' => $i,
            'username' => 'ROOT',
            'email' => 'nldev@bna.dz',
            'password' => $password,
            'must_change_password' => $mustChangePassword
        ]);

        $root->roles()->sync([1]);
        DB::unprepared('SET IDENTITY_INSERT users OFF');

        DB::unprepared('SET IDENTITY_INSERT users ON');
        $i += 1;
        $cdcr = User::create([
            'id' => $i,
            'username' => 'H.BELLOUNDJA',
            'email' => 'H.BELLOUNDJA@bna.dz',
            'password' => $password,
            'must_change_password' => $mustChangePassword
        ]);

        $cdcr->roles()->sync([4]);
        DB::unprepared('SET IDENTITY_INSERT users OFF');

        DB::unprepared('SET IDENTITY_INSERT users ON');
        $i += 1;
        $admin = User::create([
            'id' => $i,
            'username' => 'Z.BENMADI',
            'email' => 'Z.BENMADI@bna.dz',
            'password' => $password,
            'must_change_password' => $mustChangePassword
        ]);
        $admin->roles()->sync([7]);
        DB::unprepared('SET IDENTITY_INSERT users OFF');

        DB::unprepared('SET IDENTITY_INSERT users ON');
        $i += 1;
        $dcp = User::create([
            'id' => $i,
            'username' => 'DCP',
            'email' => 'DCPermanent@bna.dz',
            'password' => $password,
            'must_change_password' => $mustChangePassword
        ]);
        $dcp->roles()->sync([3]);
        DB::unprepared('SET IDENTITY_INSERT users OFF');

        DB::unprepared('SET IDENTITY_INSERT users ON');
        $i += 1;
        $cdrcp = User::create([
            'id' => $i,
            'username' => 'CDRCP',
            'email' => 'DRCP@bna.dz',
            'password' => $password,
            'must_change_password' => $mustChangePassword
        ]);
        $cdrcp->roles()->sync([8]);
        DB::unprepared('SET IDENTITY_INSERT users OFF');

        DB::unprepared('SET IDENTITY_INSERT users ON');
        $i += 1;
        $dg = User::create([
            'id' => $i,
            'username' => 'DG',
            'email' => 'DG@bna.dz',
            'password' => $password,
            'must_change_password' => $mustChangePassword
        ]);
        $dg->roles()->sync([2]);
        DB::unprepared('SET IDENTITY_INSERT users OFF');

        DB::unprepared('SET IDENTITY_INSERT users ON');
        $i += 1;
        $ig = User::create([
            'id' => $i,
            'username' => 'IG',
            'email' => 'IG@bna.dz',
            'password' => $password,
            'must_change_password' => $mustChangePassword
        ]);

        $ig->roles()->sync([9]);
        DB::unprepared('SET IDENTITY_INSERT users OFF');

        DB::unprepared('SET IDENTITY_INSERT users ON');
        $i += 1;
        $sg = User::create([
            'id' => $i,
            'username' => 'SG',
            'email' => 'SG@bna.dz',
            'password' => $password,
            'must_change_password' => $mustChangePassword
        ]);
        $sg->roles()->sync([2]);
        DB::unprepared('SET IDENTITY_INSERT users OFF');

        DB::unprepared('SET IDENTITY_INSERT users ON');
        $i += 1;
        $der = User::create([
            'id' => $i,
            'username' => 'DER',
            'email' => 'DER@bna.dz',
            'password' => $password,
            'must_change_password' => $mustChangePassword
        ]);
        $der->roles()->sync([12]);
        DB::unprepared('SET IDENTITY_INSERT users OFF');

        DB::unprepared('SET IDENTITY_INSERT users ON');
        $i += 1;
        $cc = User::create([
            'id' => $i,
            'username' => 'M.TOUAHRI',
            'email' => 'M.TOUAHRI@bna.dz',
            'password' => $password,
            'must_change_password' => $mustChangePassword
        ]);
        $cc->roles()->sync([10]);
        DB::unprepared('SET IDENTITY_INSERT users OFF');

        DB::unprepared('SET IDENTITY_INSERT users ON');
        $i += 1;
        $cc = User::create([
            'id' => $i,
            'username' => 'CC',
            'email' => 'CC@bna.dz',
            'password' => $password,
            'must_change_password' => $mustChangePassword
        ]);
        $cc->roles()->sync([10]);
        DB::unprepared('SET IDENTITY_INSERT users OFF');

        foreach (Agency::all() as $agency) {
            DB::unprepared('SET IDENTITY_INSERT users ON');
            $i += 1;
            $username = 'DA-' . $agency->code;
            $email = $username . '@bna.dz';
            $user = [
                'id' => $i,
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'must_change_password' => $mustChangePassword,
            ];
            $user = User::create($user);
            $user->agencies()->sync([$agency->id]);
            $user->roles()->sync([11]);
            DB::unprepared('SET IDENTITY_INSERT users OFF');
        }
        foreach (Dre::all() as $dre) {
            DB::unprepared('SET IDENTITY_INSERT users ON');
            $i += 1;
            $username = 'DRE-' . strtoupper(\Str::slug(str_replace('DRE ', '', $dre->name)));
            $email = $username . '@bna.dz';
            $user = [
                'id' => $i,
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'must_change_password' => $mustChangePassword,
            ];
            $user = User::create($user);
            $agencies = $dre->agencies()->pluck('id')->toArray();
            $user->agencies()->sync($agencies);
            $user->roles()->sync([13]);
            DB::unprepared('SET IDENTITY_INSERT users OFF');
        }
        foreach (Dre::all() as $dre) {
            DB::unprepared('SET IDENTITY_INSERT users ON');
            $i += 1;
            $username = 'CDC-' .  strtoupper(\Str::slug(str_replace('DRE ', '', $dre->name)));
            $email = $username . '@bna.dz';
            $user = [
                'id' => $i,
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'must_change_password' => $mustChangePassword,
            ];
            $user = User::create($user);
            $agencies = $dre->agencies()->pluck('id')->toArray();
            $user->agencies()->sync($agencies);
            $user->roles()->sync([5]);
            DB::unprepared('SET IDENTITY_INSERT users OFF');
        }

        foreach (Dre::all() as $dre) {
            DB::unprepared('SET IDENTITY_INSERT users ON');
            $i += 1;
            $username = 'CI-' . strtoupper(\Str::slug(str_replace('DRE ', '', $dre->name)));
            $email = $username . '@bna.dz';
            $user = [
                'id' => $i,
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'must_change_password' => $mustChangePassword,
            ];
            $user = User::create($user);
            $agencies = $dre->agencies()->pluck('id')->toArray();
            $user->agencies()->sync($agencies);
            $user->roles()->sync([6]);
            DB::unprepared('SET IDENTITY_INSERT users OFF');
        }
    }
    private function loadAgencies(array $data)
    {
        $data = Arr::flatten(array_map(function ($item) {
            $item = explode('-', $item);
            $ids = [];
            if ($item[0] == 'd') {
                $ids = array_merge(Dre::findOrFail($item[1])->agencies->pluck('id')->toArray(), $ids);
            } else {
                $ids = array_merge($ids, [intval($item[0])]);
            }
            return $ids;
        }, $data));
        $data = Validator::make($data, [
            '*' => 'exists:agencies,id'
        ])->validated();
        return $data;
    }
}
