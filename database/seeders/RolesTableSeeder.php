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
                'id' => 1,
                'name' => 'root',
            ),
            1 => 
            array (
                'code' => 'dg',
                'id' => 2,
                'name' => 'Directeur général',
            ),
            2 => 
            array (
                'code' => 'dcp',
                'id' => 3,
                'name' => 'Directeur du contrôle permanant',
            ),
            3 => 
            array (
                'code' => 'cdcr',
                'id' => 4,
            'name' => 'Chef de département de contrôle réseau (DCP)',
            ),
            4 => 
            array (
                'code' => 'cdc',
                'id' => 5,
            'name' => 'Chef de département de contrôle (DRE)',
            ),
            5 => 
            array (
                'code' => 'ci',
                'id' => 6,
                'name' => 'Controlleur itinérant',
            ),
            6 => 
            array (
                'code' => 'admin',
                'id' => 7,
                'name' => 'Administrateur',
            ),
            7 => 
            array (
                'code' => 'cdrcp',
                'id' => 8,
                'name' => 'Chef division des risques et du contrôle permanent',
            ),
            8 => 
            array (
                'code' => 'ig',
                'id' => 9,
                'name' => 'Inspecteur général',
            ),
            9 => 
            array (
                'code' => 'cc',
                'id' => 10,
                'name' => 'Contrôleur central',
            ),
            10 => 
            array (
                'code' => 'da',
                'id' => 11,
                'name' => 'Directeur d\'agence',
            ),
            11 => 
            array (
                'code' => 'der',
                'id' => 12,
                'name' => 'Direction encadrement réseau',
            ),
            12 => 
            array (
                'code' => 'dre',
                'id' => 13,
                'name' => 'Direction réseau exploitation',
            ),
        ));
        
        
    }
}