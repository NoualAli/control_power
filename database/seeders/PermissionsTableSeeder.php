<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'guard_name' => 'api',
                'id' => 1,
                'name' => 'edit_role',
            ),
            1 => 
            array (
                'guard_name' => 'api',
                'id' => 2,
                'name' => 'create_role',
            ),
            2 => 
            array (
                'guard_name' => 'api',
                'id' => 3,
                'name' => 'delete_role',
            ),
            3 => 
            array (
                'guard_name' => 'api',
                'id' => 4,
                'name' => 'view_role',
            ),
            4 => 
            array (
                'guard_name' => 'api',
                'id' => 5,
                'name' => 'create_user',
            ),
            5 => 
            array (
                'guard_name' => 'api',
                'id' => 6,
                'name' => 'delete_user',
            ),
            6 => 
            array (
                'guard_name' => 'api',
                'id' => 7,
                'name' => 'edit_role',
            ),
            7 => 
            array (
                'guard_name' => 'api',
                'id' => 8,
                'name' => 'view_user',
            ),
            8 => 
            array (
                'guard_name' => 'api',
                'id' => 9,
                'name' => 'create_permission',
            ),
            9 => 
            array (
                'guard_name' => 'api',
                'id' => 10,
                'name' => 'delete_permission',
            ),
            10 => 
            array (
                'guard_name' => 'api',
                'id' => 11,
                'name' => 'edit_permission',
            ),
            11 => 
            array (
                'guard_name' => 'api',
                'id' => 12,
                'name' => 'view_permission',
            ),
            12 => 
            array (
                'guard_name' => 'api',
                'id' => 13,
                'name' => 'edit_user',
            ),
            13 => 
            array (
                'guard_name' => 'api',
                'id' => 14,
                'name' => 'create_dre',
            ),
            14 => 
            array (
                'guard_name' => 'api',
                'id' => 15,
                'name' => 'edit_dre',
            ),
            15 => 
            array (
                'guard_name' => 'api',
                'id' => 16,
                'name' => 'delete_dre',
            ),
            16 => 
            array (
                'guard_name' => 'api',
                'id' => 17,
                'name' => 'view_dre',
            ),
            17 => 
            array (
                'guard_name' => 'api',
                'id' => 18,
                'name' => 'create_agency',
            ),
            18 => 
            array (
                'guard_name' => 'api',
                'id' => 19,
                'name' => 'view_agency',
            ),
            19 => 
            array (
                'guard_name' => 'api',
                'id' => 20,
                'name' => 'edit_agency',
            ),
            20 => 
            array (
                'guard_name' => 'api',
                'id' => 21,
                'name' => 'delete_agency',
            ),
            21 => 
            array (
                'guard_name' => 'api',
                'id' => 22,
                'name' => 'create_familly',
            ),
            22 => 
            array (
                'guard_name' => 'api',
                'id' => 23,
                'name' => 'view_familly',
            ),
            23 => 
            array (
                'guard_name' => 'api',
                'id' => 24,
                'name' => 'edit_familly',
            ),
            24 => 
            array (
                'guard_name' => 'api',
                'id' => 25,
                'name' => 'delete_familly',
            ),
            25 => 
            array (
                'guard_name' => 'api',
                'id' => 26,
                'name' => 'create_domain',
            ),
            26 => 
            array (
                'guard_name' => 'api',
                'id' => 27,
                'name' => 'edit_domain',
            ),
            27 => 
            array (
                'guard_name' => 'api',
                'id' => 28,
                'name' => 'view_domain',
            ),
            28 => 
            array (
                'guard_name' => 'api',
                'id' => 29,
                'name' => 'delete_domain',
            ),
            29 => 
            array (
                'guard_name' => 'api',
                'id' => 30,
                'name' => 'create_process',
            ),
            30 => 
            array (
                'guard_name' => 'api',
                'id' => 31,
                'name' => 'edit_process',
            ),
            31 => 
            array (
                'guard_name' => 'api',
                'id' => 32,
                'name' => 'view_process',
            ),
            32 => 
            array (
                'guard_name' => 'api',
                'id' => 33,
                'name' => 'delete_process',
            ),
            33 => 
            array (
                'guard_name' => 'api',
                'id' => 34,
                'name' => 'create_control_point',
            ),
            34 => 
            array (
                'guard_name' => 'api',
                'id' => 35,
                'name' => 'edit_control_point',
            ),
            35 => 
            array (
                'guard_name' => 'api',
                'id' => 36,
                'name' => 'view_control_point',
            ),
            36 => 
            array (
                'guard_name' => 'api',
                'id' => 37,
                'name' => 'delete_control_point',
            ),
            37 => 
            array (
                'guard_name' => 'api',
                'id' => 38,
                'name' => 'create_control_campaign',
            ),
            38 => 
            array (
                'guard_name' => 'api',
                'id' => 39,
                'name' => 'edit_control_campaign',
            ),
            39 => 
            array (
                'guard_name' => 'api',
                'id' => 40,
                'name' => 'view_control_campaign',
            ),
            40 => 
            array (
                'guard_name' => 'api',
                'id' => 41,
                'name' => 'delete_control_campaign',
            ),
            41 => 
            array (
                'guard_name' => 'api',
                'id' => 42,
                'name' => 'create_mission',
            ),
            42 => 
            array (
                'guard_name' => 'api',
                'id' => 43,
                'name' => 'edit_mission',
            ),
            43 => 
            array (
                'guard_name' => 'api',
                'id' => 44,
                'name' => 'delete_mission',
            ),
            44 => 
            array (
                'guard_name' => 'api',
                'id' => 45,
                'name' => 'view_mission',
            ),
            45 => 
            array (
                'guard_name' => 'api',
                'id' => 46,
                'name' => 'control_agency',
            ),
            46 => 
            array (
                'guard_name' => 'api',
                'id' => 47,
                'name' => 'add_opinion',
            ),
        ));
        
        
    }
}