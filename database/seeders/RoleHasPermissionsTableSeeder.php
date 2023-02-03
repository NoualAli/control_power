<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RoleHasPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('role_has_permissions')->delete();
        
        \DB::table('role_has_permissions')->insert(array (
            0 => 
            array (
                'id' => 1,
                'permission_id' => 1,
                'role_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'permission_id' => 2,
                'role_id' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'permission_id' => 3,
                'role_id' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'permission_id' => 4,
                'role_id' => 1,
            ),
            4 => 
            array (
                'id' => 5,
                'permission_id' => 5,
                'role_id' => 1,
            ),
            5 => 
            array (
                'id' => 6,
                'permission_id' => 6,
                'role_id' => 1,
            ),
            6 => 
            array (
                'id' => 7,
                'permission_id' => 7,
                'role_id' => 1,
            ),
            7 => 
            array (
                'id' => 8,
                'permission_id' => 8,
                'role_id' => 1,
            ),
            8 => 
            array (
                'id' => 9,
                'permission_id' => 9,
                'role_id' => 1,
            ),
            9 => 
            array (
                'id' => 10,
                'permission_id' => 10,
                'role_id' => 1,
            ),
            10 => 
            array (
                'id' => 11,
                'permission_id' => 11,
                'role_id' => 1,
            ),
            11 => 
            array (
                'id' => 12,
                'permission_id' => 12,
                'role_id' => 1,
            ),
            12 => 
            array (
                'id' => 13,
                'permission_id' => 13,
                'role_id' => 1,
            ),
            13 => 
            array (
                'id' => 14,
                'permission_id' => 14,
                'role_id' => 1,
            ),
            14 => 
            array (
                'id' => 15,
                'permission_id' => 15,
                'role_id' => 1,
            ),
            15 => 
            array (
                'id' => 16,
                'permission_id' => 16,
                'role_id' => 1,
            ),
            16 => 
            array (
                'id' => 17,
                'permission_id' => 17,
                'role_id' => 1,
            ),
            17 => 
            array (
                'id' => 18,
                'permission_id' => 18,
                'role_id' => 1,
            ),
            18 => 
            array (
                'id' => 19,
                'permission_id' => 19,
                'role_id' => 1,
            ),
            19 => 
            array (
                'id' => 20,
                'permission_id' => 20,
                'role_id' => 1,
            ),
            20 => 
            array (
                'id' => 21,
                'permission_id' => 21,
                'role_id' => 1,
            ),
            21 => 
            array (
                'id' => 22,
                'permission_id' => 22,
                'role_id' => 1,
            ),
            22 => 
            array (
                'id' => 23,
                'permission_id' => 23,
                'role_id' => 1,
            ),
            23 => 
            array (
                'id' => 24,
                'permission_id' => 24,
                'role_id' => 1,
            ),
            24 => 
            array (
                'id' => 25,
                'permission_id' => 25,
                'role_id' => 1,
            ),
            25 => 
            array (
                'id' => 26,
                'permission_id' => 26,
                'role_id' => 1,
            ),
            26 => 
            array (
                'id' => 27,
                'permission_id' => 27,
                'role_id' => 1,
            ),
            27 => 
            array (
                'id' => 28,
                'permission_id' => 28,
                'role_id' => 1,
            ),
            28 => 
            array (
                'id' => 29,
                'permission_id' => 29,
                'role_id' => 1,
            ),
            29 => 
            array (
                'id' => 30,
                'permission_id' => 30,
                'role_id' => 1,
            ),
            30 => 
            array (
                'id' => 31,
                'permission_id' => 31,
                'role_id' => 1,
            ),
            31 => 
            array (
                'id' => 32,
                'permission_id' => 32,
                'role_id' => 1,
            ),
            32 => 
            array (
                'id' => 33,
                'permission_id' => 33,
                'role_id' => 1,
            ),
            33 => 
            array (
                'id' => 34,
                'permission_id' => 34,
                'role_id' => 1,
            ),
            34 => 
            array (
                'id' => 35,
                'permission_id' => 35,
                'role_id' => 1,
            ),
            35 => 
            array (
                'id' => 36,
                'permission_id' => 36,
                'role_id' => 1,
            ),
            36 => 
            array (
                'id' => 37,
                'permission_id' => 37,
                'role_id' => 1,
            ),
            37 => 
            array (
                'id' => 38,
                'permission_id' => 8,
                'role_id' => 7,
            ),
            38 => 
            array (
                'id' => 39,
                'permission_id' => 14,
                'role_id' => 7,
            ),
            39 => 
            array (
                'id' => 40,
                'permission_id' => 15,
                'role_id' => 7,
            ),
            40 => 
            array (
                'id' => 41,
                'permission_id' => 16,
                'role_id' => 7,
            ),
            41 => 
            array (
                'id' => 42,
                'permission_id' => 17,
                'role_id' => 7,
            ),
            42 => 
            array (
                'id' => 43,
                'permission_id' => 18,
                'role_id' => 7,
            ),
            43 => 
            array (
                'id' => 44,
                'permission_id' => 19,
                'role_id' => 7,
            ),
            44 => 
            array (
                'id' => 45,
                'permission_id' => 20,
                'role_id' => 7,
            ),
            45 => 
            array (
                'id' => 46,
                'permission_id' => 21,
                'role_id' => 7,
            ),
            46 => 
            array (
                'id' => 47,
                'permission_id' => 22,
                'role_id' => 7,
            ),
            47 => 
            array (
                'id' => 48,
                'permission_id' => 23,
                'role_id' => 7,
            ),
            48 => 
            array (
                'id' => 49,
                'permission_id' => 24,
                'role_id' => 7,
            ),
            49 => 
            array (
                'id' => 50,
                'permission_id' => 25,
                'role_id' => 7,
            ),
            50 => 
            array (
                'id' => 51,
                'permission_id' => 26,
                'role_id' => 7,
            ),
            51 => 
            array (
                'id' => 52,
                'permission_id' => 27,
                'role_id' => 7,
            ),
            52 => 
            array (
                'id' => 53,
                'permission_id' => 28,
                'role_id' => 7,
            ),
            53 => 
            array (
                'id' => 54,
                'permission_id' => 29,
                'role_id' => 7,
            ),
            54 => 
            array (
                'id' => 55,
                'permission_id' => 30,
                'role_id' => 7,
            ),
            55 => 
            array (
                'id' => 56,
                'permission_id' => 31,
                'role_id' => 7,
            ),
            56 => 
            array (
                'id' => 57,
                'permission_id' => 32,
                'role_id' => 7,
            ),
            57 => 
            array (
                'id' => 58,
                'permission_id' => 33,
                'role_id' => 7,
            ),
            58 => 
            array (
                'id' => 59,
                'permission_id' => 34,
                'role_id' => 7,
            ),
            59 => 
            array (
                'id' => 60,
                'permission_id' => 35,
                'role_id' => 7,
            ),
            60 => 
            array (
                'id' => 61,
                'permission_id' => 36,
                'role_id' => 7,
            ),
            61 => 
            array (
                'id' => 62,
                'permission_id' => 37,
                'role_id' => 7,
            ),
            62 => 
            array (
                'id' => 63,
                'permission_id' => 5,
                'role_id' => 7,
            ),
            63 => 
            array (
                'id' => 64,
                'permission_id' => 13,
                'role_id' => 7,
            ),
            64 => 
            array (
                'id' => 65,
                'permission_id' => 38,
                'role_id' => 3,
            ),
            65 => 
            array (
                'id' => 66,
                'permission_id' => 39,
                'role_id' => 3,
            ),
            66 => 
            array (
                'id' => 67,
                'permission_id' => 40,
                'role_id' => 3,
            ),
            67 => 
            array (
                'id' => 68,
                'permission_id' => 41,
                'role_id' => 3,
            ),
            68 => 
            array (
                'id' => 69,
                'permission_id' => 42,
                'role_id' => 5,
            ),
            69 => 
            array (
                'id' => 70,
                'permission_id' => 43,
                'role_id' => 5,
            ),
            70 => 
            array (
                'id' => 71,
                'permission_id' => 44,
                'role_id' => 5,
            ),
            71 => 
            array (
                'id' => 72,
                'permission_id' => 45,
                'role_id' => 5,
            ),
            72 => 
            array (
                'id' => 73,
                'permission_id' => 46,
                'role_id' => 6,
            ),
            73 => 
            array (
                'id' => 74,
                'permission_id' => 40,
                'role_id' => 6,
            ),
            74 => 
            array (
                'id' => 75,
                'permission_id' => 45,
                'role_id' => 6,
            ),
            75 => 
            array (
                'id' => 76,
                'permission_id' => 40,
                'role_id' => 5,
            ),
            76 => 
            array (
                'id' => 77,
                'permission_id' => 47,
                'role_id' => 6,
            ),
        ));
        
        
    }
}