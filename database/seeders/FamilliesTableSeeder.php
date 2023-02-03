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
                'name' => 'Commerciale',
            ),
            2 => 
            array (
                'id' => 2,
                'name' => 'Engagement',
            ),
        ));
        
        
    }
}