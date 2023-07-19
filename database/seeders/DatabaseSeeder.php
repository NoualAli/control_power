<?php

namespace Database\Seeders;

use App\Imports\ControlPointsImport;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new ControlPointsImport, public_path('pcf.xlsx'));

        if (env('DB_CONNECTION') == 'mysql') {
            $this->call(UsersTableSeeder::class);
        } else {
            DB::unprepared('SET IDENTITY_INSERT users ON');
            $this->call(UsersTableSeeder::class);
            DB::unprepared('SET IDENTITY_INSERT users OFF');
        }

        if (env('DB_CONNECTION') == 'mysql') {
            $this->call(RolesTableSeeder::class);
        } else {
            DB::unprepared('SET IDENTITY_INSERT roles ON');
            $this->call(RolesTableSeeder::class);
            DB::unprepared('SET IDENTITY_INSERT roles OFF');
        }

        if (env('DB_CONNECTION') == 'mysql') {
            $this->call(PermissionsTableSeeder::class);
        } else {
            DB::unprepared('SET IDENTITY_INSERT permissions ON');
            $this->call(PermissionsTableSeeder::class);
            DB::unprepared('SET IDENTITY_INSERT permissions OFF');
        }

        $this->call(RoleHasPermissionsTableSeeder::class);
        $this->call(UserHasRolesTableSeeder::class);

        if (env('DB_CONNECTION') == 'mysql') {
            $this->call(DresTableSeeder::class);
        } else {
            DB::unprepared('SET IDENTITY_INSERT dres ON');
            $this->call(DresTableSeeder::class);
            DB::unprepared('SET IDENTITY_INSERT dres OFF');
        }

        if (env('DB_CONNECTION') == 'mysql') {
            $this->call(CategoriesTableSeeder::class);
        } else {
            DB::unprepared('SET IDENTITY_INSERT categories ON');
            $this->call(CategoriesTableSeeder::class);
            DB::unprepared('SET IDENTITY_INSERT categories OFF');
        }

        $this->call(CategoryHasProcessesTableSeeder::class);

        if (env('DB_CONNECTION') == 'mysql') {
            $this->call(AgenciesTableSeeder::class);
        } else {
            DB::unprepared('SET IDENTITY_INSERT agencies ON');
            $this->call(AgenciesTableSeeder::class);
            DB::unprepared('SET IDENTITY_INSERT agencies OFF');
        }

        $this->call(UserHasAgenciesTableSeeder::class);
    }
}
