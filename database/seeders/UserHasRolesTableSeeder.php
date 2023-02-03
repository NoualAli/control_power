<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserHasRolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('user_has_roles')->delete();
        
        \DB::table('user_has_roles')->insert(array (
            0 => 
            array (
                'role_id' => 1,
                'user_id' => 1,
            ),
            1 => 
            array (
                'role_id' => 3,
                'user_id' => 2,
            ),
            2 => 
            array (
                'role_id' => 5,
                'user_id' => 4,
            ),
            3 => 
            array (
                'role_id' => 6,
                'user_id' => 5,
            ),
            4 => 
            array (
                'role_id' => 6,
                'user_id' => 6,
            ),
            5 => 
            array (
                'role_id' => 2,
                'user_id' => 7,
            ),
            6 => 
            array (
                'role_id' => 5,
                'user_id' => 8,
            ),
            7 => 
            array (
                'role_id' => 2,
                'user_id' => 3,
            ),
            8 => 
            array (
                'role_id' => 5,
                'user_id' => 9,
            ),
            9 => 
            array (
                'role_id' => 5,
                'user_id' => 10,
            ),
            10 => 
            array (
                'role_id' => 5,
                'user_id' => 11,
            ),
            11 => 
            array (
                'role_id' => 5,
                'user_id' => 12,
            ),
            12 => 
            array (
                'role_id' => 5,
                'user_id' => 13,
            ),
            13 => 
            array (
                'role_id' => 6,
                'user_id' => 14,
            ),
            14 => 
            array (
                'role_id' => 6,
                'user_id' => 15,
            ),
            15 => 
            array (
                'role_id' => 6,
                'user_id' => 16,
            ),
            16 => 
            array (
                'role_id' => 6,
                'user_id' => 17,
            ),
            17 => 
            array (
                'role_id' => 5,
                'user_id' => 18,
            ),
            18 => 
            array (
                'role_id' => 6,
                'user_id' => 19,
            ),
            19 => 
            array (
                'role_id' => 5,
                'user_id' => 20,
            ),
            20 => 
            array (
                'role_id' => 6,
                'user_id' => 21,
            ),
            21 => 
            array (
                'role_id' => 7,
                'user_id' => 22,
            ),
        ));
        
        
    }
}