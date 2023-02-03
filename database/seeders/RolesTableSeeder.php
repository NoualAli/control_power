<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'code' => 'root',
                'guard_name' => 'api',
                'id' => 1,
                'name' => 'root',
            ),
            1 => 
            array (
                'code' => 'dg',
                'guard_name' => 'api',
                'id' => 2,
                'name' => 'Directeur général',
            ),
            2 => 
            array (
                'code' => 'dcp',
                'guard_name' => 'api',
                'id' => 3,
                'name' => 'Directeur du contrôle permanant',
            ),
            3 => 
            array (
                'code' => 'cdr',
                'guard_name' => 'api',
                'id' => 4,
                'name' => 'Chef département réseau',
            ),
            4 => 
            array (
                'code' => 'cdc',
                'guard_name' => 'api',
                'id' => 5,
                'name' => 'Chef de département contrôle',
            ),
            5 => 
            array (
                'code' => 'ci',
                'guard_name' => 'api',
                'id' => 6,
                'name' => 'controlleur itinérant',
            ),
            6 => 
            array (
                'code' => 'admin',
                'guard_name' => 'api',
                'id' => 7,
                'name' => 'admin',
            ),
        ));
        
        
    }
}