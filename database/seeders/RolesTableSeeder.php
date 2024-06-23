<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['code' => 'iga', 'name' => 'Inspecteur général adjoint'],
            ['code' => 'ir', 'name' => 'Inspecteur régional'],
            ['code' => 'cd', 'name' => 'Chef département']
        ]);
    }
}
