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
                'id' => '1',
                'name' => 'root',
                'code' => 'root',
            ),
            1 => 
            array (
                'id' => '2',
                'name' => 'Directeur général',
                'code' => 'dg',
            ),
            2 => 
            array (
                'id' => '3',
                'name' => 'Directeur du contrôle permanant',
                'code' => 'dcp',
            ),
            3 => 
            array (
                'id' => '4',
            'name' => 'Chef de département de contrôle réseau (DCP)',
                'code' => 'cdcr',
            ),
            4 => 
            array (
                'id' => '5',
            'name' => 'Chef de département de contrôle (DRE)',
                'code' => 'cdc',
            ),
            5 => 
            array (
                'id' => '6',
                'name' => 'Controlleur itinérant',
                'code' => 'ci',
            ),
            6 => 
            array (
                'id' => '7',
                'name' => 'Admin',
                'code' => 'admin',
            ),
            7 => 
            array (
                'id' => '8',
                'name' => 'Chef division des risques et du contrôle permanent',
                'code' => 'cdrcp',
            ),
            8 => 
            array (
                'id' => '9',
                'name' => 'Inspecteur général',
                'code' => 'ig',
            ),
            9 => 
            array (
                'id' => '10',
                'name' => 'Contrôleur central',
                'code' => 'cc',
            ),
            10 => 
            array (
                'id' => '11',
                'name' => 'Directeur d\'agence',
                'code' => 'da',
            ),
            11 => 
            array (
                'id' => '12',
                'name' => 'Direction encadrement réseau',
                'code' => 'der',
            ),
            12 => 
            array (
                'id' => '13',
                'name' => 'Direction réseau exploitation',
                'code' => 'dre',
            ),
        ));
        
        
    }
}