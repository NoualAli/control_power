<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModulesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('modules')->delete();
        
        \DB::table('modules')->insert(array (
            0 => 
            array (
                'code' => 'data_management',
                'description' => NULL,
                'id' => 1,
                'name' => 'Gestion des données directrice',
            ),
            1 => 
            array (
                'code' => 'user_mangement',
                'description' => NULL,
                'id' => 2,
                'name' => 'Gestion des utilisateurs',
            ),
            2 => 
            array (
                'code' => 'second_level_missions',
                'description' => NULL,
                'id' => 3,
                'name' => 'Mission de 2ème niveau',
            ),
            3 => 
            array (
                'code' => 'control_campaigns',
                'description' => NULL,
                'id' => 4,
                'name' => 'Campagne de contrôle',
            ),
            4 => 
            array (
                'code' => 'pcf_management',
                'description' => NULL,
                'id' => 5,
                'name' => 'Gestion des PCF',
            ),
            5 => 
            array (
                'code' => 'second_level_control',
                'description' => NULL,
                'id' => 6,
                'name' => 'Contrôle 2ème niveau',
            ),
        ));
        
        
    }
}