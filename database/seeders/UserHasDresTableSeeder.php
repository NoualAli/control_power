<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserHasDresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_has_dres')->delete();
        
        \DB::table('user_has_dres')->insert(array (
            0 => 
            array (
                'dre_id' => 14,
                'user_id' => 4,
            ),
            1 => 
            array (
                'dre_id' => 14,
                'user_id' => 5,
            ),
            2 => 
            array (
                'dre_id' => 14,
                'user_id' => 6,
            ),
            3 => 
            array (
                'dre_id' => 9,
                'user_id' => 10,
            ),
            4 => 
            array (
                'dre_id' => 18,
                'user_id' => 11,
            ),
            5 => 
            array (
                'dre_id' => 12,
                'user_id' => 12,
            ),
            6 => 
            array (
                'dre_id' => 19,
                'user_id' => 13,
            ),
            7 => 
            array (
                'dre_id' => 9,
                'user_id' => 14,
            ),
            8 => 
            array (
                'dre_id' => 18,
                'user_id' => 15,
            ),
            9 => 
            array (
                'dre_id' => 12,
                'user_id' => 16,
            ),
            10 => 
            array (
                'dre_id' => 19,
                'user_id' => 17,
            ),
            11 => 
            array (
                'dre_id' => 15,
                'user_id' => 18,
            ),
            12 => 
            array (
                'dre_id' => 15,
                'user_id' => 19,
            ),
            13 => 
            array (
                'dre_id' => 16,
                'user_id' => 20,
            ),
            14 => 
            array (
                'dre_id' => 16,
                'user_id' => 21,
            ),
        ));
        
        
    }
}