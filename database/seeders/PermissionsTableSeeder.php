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
                'id' => 1,
                'name' => 'edit_role',
                'guard_name' => 'api',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'create_role',
                'guard_name' => 'api',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'delete_role',
                'guard_name' => 'api',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'view_role',
                'guard_name' => 'api',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'create_user',
                'guard_name' => 'api',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'delete_user',
                'guard_name' => 'api',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'edit_role',
                'guard_name' => 'api',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'view_user',
                'guard_name' => 'api',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'create_permission',
                'guard_name' => 'api',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'delete_permission',
                'guard_name' => 'api',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'edit_permission',
                'guard_name' => 'api',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'view_permission',
                'guard_name' => 'api',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'edit_user',
                'guard_name' => 'api',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'create_dre',
                'guard_name' => 'api',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'edit_dre',
                'guard_name' => 'api',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'delete_dre',
                'guard_name' => 'api',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'view_dre',
                'guard_name' => 'api',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'create_agency',
                'guard_name' => 'api',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'view_agency',
                'guard_name' => 'api',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'edit_agency',
                'guard_name' => 'api',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'delete_agency',
                'guard_name' => 'api',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'create_familly',
                'guard_name' => 'api',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'view_familly',
                'guard_name' => 'api',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'edit_familly',
                'guard_name' => 'api',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'delete_familly',
                'guard_name' => 'api',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'create_domain',
                'guard_name' => 'api',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'edit_domain',
                'guard_name' => 'api',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'view_domain',
                'guard_name' => 'api',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'delete_domain',
                'guard_name' => 'api',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'create_process',
                'guard_name' => 'api',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'edit_process',
                'guard_name' => 'api',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'view_process',
                'guard_name' => 'api',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'delete_process',
                'guard_name' => 'api',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'create_control_point',
                'guard_name' => 'api',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'edit_control_point',
                'guard_name' => 'api',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'view_control_point',
                'guard_name' => 'api',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'delete_control_point',
                'guard_name' => 'api',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'create_control_campaign',
                'guard_name' => 'api',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'edit_control_campaign',
                'guard_name' => 'api',
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'view_control_campaign',
                'guard_name' => 'api',
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'delete_control_campaign',
                'guard_name' => 'api',
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'create_mission',
                'guard_name' => 'api',
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'edit_mission',
                'guard_name' => 'api',
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'delete_mission',
                'guard_name' => 'api',
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'view_mission',
                'guard_name' => 'api',
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'control_agency',
                'guard_name' => 'api',
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'create_opinion',
                'guard_name' => 'api',
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'create_report',
                'guard_name' => 'api',
            ),
        ));
        
        
    }
}