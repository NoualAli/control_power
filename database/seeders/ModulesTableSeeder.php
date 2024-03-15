<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModulesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::table('modules')->where('code', 'data_management')->update([
            'code' => 'structures_management',
            'name' => 'Gestion des structures',
        ]);
    }
}
