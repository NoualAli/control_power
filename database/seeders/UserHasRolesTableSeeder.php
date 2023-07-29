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
                'role_id' => 2,
                'user_id' => 4,
            ),
            3 => 
            array (
                'role_id' => 8,
                'user_id' => 3,
            ),
            4 => 
            array (
                'role_id' => 5,
                'user_id' => 40,
            ),
            5 => 
            array (
                'role_id' => 6,
                'user_id' => 41,
            ),
            6 => 
            array (
                'role_id' => 5,
                'user_id' => 44,
            ),
            7 => 
            array (
                'role_id' => 6,
                'user_id' => 45,
            ),
            8 => 
            array (
                'role_id' => 11,
                'user_id' => 46,
            ),
            9 => 
            array (
                'role_id' => 4,
                'user_id' => 47,
            ),
            10 => 
            array (
                'role_id' => 13,
                'user_id' => 48,
            ),
            11 => 
            array (
                'role_id' => 13,
                'user_id' => 49,
            ),
            12 => 
            array (
                'role_id' => 13,
                'user_id' => 50,
            ),
            13 => 
            array (
                'role_id' => 5,
                'user_id' => 52,
            ),
            14 => 
            array (
                'role_id' => 5,
                'user_id' => 53,
            ),
            15 => 
            array (
                'role_id' => 7,
                'user_id' => 17,
            ),
            16 => 
            array (
                'role_id' => 5,
                'user_id' => 54,
            ),
            17 => 
            array (
                'role_id' => 10,
                'user_id' => 19,
            ),
            18 => 
            array (
                'role_id' => 9,
                'user_id' => 20,
            ),
            19 => 
            array (
                'role_id' => 7,
                'user_id' => 23,
            ),
            20 => 
            array (
                'role_id' => 6,
                'user_id' => 55,
            ),
            21 => 
            array (
                'role_id' => 12,
                'user_id' => 25,
            ),
            22 => 
            array (
                'role_id' => 4,
                'user_id' => 26,
            ),
            23 => 
            array (
                'role_id' => 4,
                'user_id' => 27,
            ),
            24 => 
            array (
                'role_id' => 6,
                'user_id' => 56,
            ),
            25 => 
            array (
                'role_id' => 6,
                'user_id' => 57,
            ),
            26 => 
            array (
                'role_id' => 11,
                'user_id' => 58,
            ),
            27 => 
            array (
                'role_id' => 11,
                'user_id' => 59,
            ),
            28 => 
            array (
                'role_id' => 11,
                'user_id' => 60,
            ),
            29 => 
            array (
                'role_id' => 11,
                'user_id' => 61,
            ),
            30 => 
            array (
                'role_id' => 11,
                'user_id' => 62,
            ),
            31 => 
            array (
                'role_id' => 11,
                'user_id' => 63,
            ),
            32 => 
            array (
                'role_id' => 11,
                'user_id' => 64,
            ),
            33 => 
            array (
                'role_id' => 11,
                'user_id' => 65,
            ),
            34 => 
            array (
                'role_id' => 5,
                'user_id' => 38,
            ),
            35 => 
            array (
                'role_id' => 6,
                'user_id' => 39,
            ),
            36 => 
            array (
                'role_id' => 11,
                'user_id' => 66,
            ),
            37 => 
            array (
                'role_id' => 13,
                'user_id' => 68,
            ),
            38 => 
            array (
                'role_id' => 11,
                'user_id' => 69,
            ),
            39 => 
            array (
                'role_id' => 5,
                'user_id' => 70,
            ),
            40 => 
            array (
                'role_id' => 6,
                'user_id' => 71,
            ),
            41 => 
            array (
                'role_id' => 13,
                'user_id' => 72,
            ),
            42 => 
            array (
                'role_id' => 11,
                'user_id' => 73,
            ),
            43 => 
            array (
                'role_id' => 5,
                'user_id' => 74,
            ),
            44 => 
            array (
                'role_id' => 6,
                'user_id' => 75,
            ),
            45 => 
            array (
                'role_id' => 13,
                'user_id' => 76,
            ),
            46 => 
            array (
                'role_id' => 5,
                'user_id' => 77,
            ),
            47 => 
            array (
                'role_id' => 6,
                'user_id' => 78,
            ),
            48 => 
            array (
                'role_id' => 11,
                'user_id' => 79,
            ),
            49 => 
            array (
                'role_id' => 13,
                'user_id' => 80,
            ),
            50 => 
            array (
                'role_id' => 5,
                'user_id' => 81,
            ),
            51 => 
            array (
                'role_id' => 6,
                'user_id' => 82,
            ),
            52 => 
            array (
                'role_id' => 11,
                'user_id' => 83,
            ),
            53 => 
            array (
                'role_id' => 13,
                'user_id' => 84,
            ),
            54 => 
            array (
                'role_id' => 5,
                'user_id' => 85,
            ),
            55 => 
            array (
                'role_id' => 6,
                'user_id' => 86,
            ),
            56 => 
            array (
                'role_id' => 11,
                'user_id' => 87,
            ),
            57 => 
            array (
                'role_id' => 2,
                'user_id' => 67,
            ),
            58 => 
            array (
                'role_id' => 13,
                'user_id' => 51,
            ),
        ));
        
        
    }
}