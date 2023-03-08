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
                'code' => 'cdcr',
                'guard_name' => 'api',
                'id' => 4,
            'name' => 'chef de département de contrôle réseau (DCP)',
            ),
            4 => 
            array (
                'code' => 'cdc',
                'guard_name' => 'api',
                'id' => 5,
            'name' => 'Chef de département de contrôle (DRE)',
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
            7 => 
            array (
                'code' => 'cdrcp',
                'guard_name' => 'api',
                'id' => 8,
                'name' => 'Chef division des risques et du contrôle permanent',
            ),
            8 => 
            array (
                'code' => 'ig',
                'guard_name' => 'api',
                'id' => 9,
                'name' => 'Inspecteur général',
            ),
            9 => 
            array (
                'code' => 'cc',
                'guard_name' => 'api',
                'id' => 10,
                'name' => 'Contrôleur central',
            ),
            10 => 
            array (
                'code' => 'da',
                'guard_name' => 'api',
                'id' => 11,
                'name' => 'Directeur d\'agence',
            ),
            11 => 
            array (
                'code' => 'der',
                'guard_name' => 'api',
                'id' => 12,
                'name' => 'Direction encadrement réseau',
            ),
            12 => 
            array (
                'code' => 'dre',
                'guard_name' => 'api',
                'id' => 13,
                'name' => 'Direction réseau exploitation',
            ),
        ));
        
        
    }
}