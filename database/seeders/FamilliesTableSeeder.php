<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class FamilliesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('famillies')->delete();
        
        \DB::table('famillies')->insert(array (
            0 => 
            array (
                'id' => 3,
                'name' => 'Commerce extérieur',
            ),
            1 => 
            array (
                'id' => 1,
                'name' => 'commerciale',
            ),
            2 => 
            array (
                'id' => 5,
                'name' => 'Contrôle',
            ),
            3 => 
            array (
                'id' => 2,
                'name' => 'Engagement',
            ),
            4 => 
            array (
                'id' => 4,
                'name' => 'Finances',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Support et administration',
            ),
        ));
        
        
    }
}