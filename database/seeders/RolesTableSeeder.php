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
                'id' => 1,
                'name' => 'root',
                'code' => 'root',
                'guard_name' => 'api',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Directeur général',
                'code' => 'dg',
                'guard_name' => 'api',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Directeur du contrôle permanant',
                'code' => 'dcp',
                'guard_name' => 'api',
            ),
            3 => 
            array (
                'id' => 4,
            'name' => 'chef de département de contrôle réseau (DCP)',
                'code' => 'cdcr',
                'guard_name' => 'api',
            ),
            4 => 
            array (
                'id' => 5,
            'name' => 'Chef de département de contrôle (DRE)',
                'code' => 'cdc',
                'guard_name' => 'api',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'controlleur itinérant',
                'code' => 'ci',
                'guard_name' => 'api',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'admin',
                'code' => 'admin',
                'guard_name' => 'api',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Chef division des risques et du contrôle permanent',
                'code' => 'cdrcp',
                'guard_name' => 'api',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Inspecteur général',
                'code' => 'ig',
                'guard_name' => 'api',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Contrôleur central',
                'code' => 'cc',
                'guard_name' => 'api',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Directeur d\'agence',
                'code' => 'da',
                'guard_name' => 'api',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Direction encadrement réseau',
                'code' => 'der',
                'guard_name' => 'api',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Direction réseau exploitation',
                'code' => 'dre',
                'guard_name' => 'api',
            ),
        ));
        
        
    }
}