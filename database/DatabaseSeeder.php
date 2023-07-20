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

        DB::unprepared('SET IDENTITY_INSERT users ON');
        $this->call(UsersTableSeeder::class);
        DB::unprepared('SET IDENTITY_INSERT users OFF');

        DB::unprepared('SET IDENTITY_INSERT roles ON');
        $this->call(RolesTableSeeder::class);
        DB::unprepared('SET IDENTITY_INSERT roles OFF');

        DB::unprepared('SET IDENTITY_INSERT permissions ON');
        $this->call(PermissionsTableSeeder::class);
        DB::unprepared('SET IDENTITY_INSERT permissions OFF');

        $this->call(RoleHasPermissionsTableSeeder::class);
        $this->call(UserHasRolesTableSeeder::class);

        DB::unprepared('SET IDENTITY_INSERT dres ON');
        $this->call(DresTableSeeder::class);
        DB::unprepared('SET IDENTITY_INSERT dres OFF');

        DB::unprepared('SET IDENTITY_INSERT categories ON');
        $this->call(CategoriesTableSeeder::class);
        DB::unprepared('SET IDENTITY_INSERT categories OFF');

        $this->call(CategoryHasProcessesTableSeeder::class);

        DB::unprepared('SET IDENTITY_INSERT agencies ON');
        $this->call(AgenciesTableSeeder::class);
        DB::unprepared('SET IDENTITY_INSERT agencies OFF');

        $this->call(UserHasAgenciesTableSeeder::class);
    }
}
