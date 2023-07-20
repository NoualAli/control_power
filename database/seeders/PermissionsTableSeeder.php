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

        \DB::table('permissions')->insert(array(
            0 =>
            array(
                'id' => '56',
                'name' => 'assign_mission_processing',
            ),
            1 =>
            array(
                'id' => '46',
                'name' => 'control_agency',
            ),
            2 =>
            array(
                'id' => '18',
                'name' => 'create_agency',
            ),
            3 =>
            array(
                'id' => '76',
                'name' => 'create_category',
            ),
            4 =>
            array(
                'id' => '38',
                'name' => 'create_control_campaign',
            ),
            5 =>
            array(
                'id' => '34',
                'name' => 'create_control_point',
            ),
            6 =>
            array(
                'id' => '26',
                'name' => 'create_domain',
            ),
            7 =>
            array(
                'id' => '14',
                'name' => 'create_dre',
            ),
            8 =>
            array(
                'id' => '48',
                'name' => 'create_cdc_report',
            ),
            9 =>
            array(
                'id' => '22',
                'name' => 'create_familly',
            ),
            10 =>
            array(
                'id' => '42',
                'name' => 'create_mission',
            ),
            11 =>
            array(
                'id' => '47',
                'name' => 'create_ci_report',
            ),
            12 =>
            array(
                'id' => '9',
                'name' => 'create_permission',
            ),
            13 =>
            array(
                'id' => '30',
                'name' => 'create_process',
            ),
            14 =>
            array(
                'id' => '2',
                'name' => 'create_role',
            ),
            15 =>
            array(
                'id' => '5',
                'name' => 'create_user',
            ),
            16 =>
            array(
                'id' => '21',
                'name' => 'delete_agency',
            ),
            17 =>
            array(
                'id' => '78',
                'name' => 'delete_category',
            ),
            18 =>
            array(
                'id' => '41',
                'name' => 'delete_control_campaign',
            ),
            19 =>
            array(
                'id' => '37',
                'name' => 'delete_control_point',
            ),
            20 =>
            array(
                'id' => '29',
                'name' => 'delete_domain',
            ),
            21 =>
            array(
                'id' => '16',
                'name' => 'delete_dre',
            ),
            22 =>
            array(
                'id' => '25',
                'name' => 'delete_familly',
            ),
            23 =>
            array(
                'id' => '44',
                'name' => 'delete_mission',
            ),
            24 =>
            array(
                'id' => '10',
                'name' => 'delete_permission',
            ),
            25 =>
            array(
                'id' => '33',
                'name' => 'delete_process',
            ),
            26 =>
            array(
                'id' => '3',
                'name' => 'delete_role',
            ),
            27 =>
            array(
                'id' => '6',
                'name' => 'delete_user',
            ),
            28 =>
            array(
                'id' => '58',
                'name' => 'dispatch_major_fact',
            ),
            29 =>
            array(
                'id' => '20',
                'name' => 'edit_agency',
            ),
            30 =>
            array(
                'id' => '77',
                'name' => 'edit_category',
            ),
            31 =>
            array(
                'id' => '39',
                'name' => 'edit_control_campaign',
            ),
            32 =>
            array(
                'id' => '35',
                'name' => 'edit_control_point',
            ),
            33 =>
            array(
                'id' => '27',
                'name' => 'edit_domain',
            ),
            34 =>
            array(
                'id' => '15',
                'name' => 'edit_dre',
            ),
            35 =>
            array(
                'id' => '24',
                'name' => 'edit_familly',
            ),
            36 =>
            array(
                'id' => '43',
                'name' => 'edit_mission',
            ),
            37 =>
            array(
                'id' => '11',
                'name' => 'edit_permission',
            ),
            38 =>
            array(
                'id' => '31',
                'name' => 'edit_process',
            ),
            39 =>
            array(
                'id' => '1',
                'name' => 'edit_role',
            ),
            40 =>
            array(
                'id' => '13',
                'name' => 'edit_user',
            ),
            41 =>
            array(
                'id' => '57',
                'name' => 'fetch_processes_list',
            ),
            42 =>
            array(
                'id' => '72',
                'name' => 'make_first_validation',
            ),
            43 =>
            array(
                'id' => '73',
                'name' => 'make_second_validation',
            ),
            44 =>
            array(
                'id' => '55',
                'name' => 'process_mission',
            ),
            45 =>
            array(
                'id' => '74',
                'name' => 'regularize_mission_detail',
            ),
            46 =>
            array(
                'id' => '75',
                'name' => 'validate_control_campaign',
            ),
            47 =>
            array(
                'id' => '50',
                'name' => 'validate_cdc_report',
            ),
            48 =>
            array(
                'id' => '51',
                'name' => 'validate_ci_report',
            ),
            49 =>
            array(
                'id' => '19',
                'name' => 'view_agency',
            ),
            50 =>
            array(
                'id' => '79',
                'name' => 'view_category',
            ),
            51 =>
            array(
                'id' => '40',
                'name' => 'view_control_campaign',
            ),
            52 =>
            array(
                'id' => '36',
                'name' => 'view_control_point',
            ),
            53 =>
            array(
                'id' => '28',
                'name' => 'view_domain',
            ),
            54 =>
            array(
                'id' => '17',
                'name' => 'view_dre',
            ),
            55 =>
            array(
                'id' => '54',
                'name' => 'view_dre_report',
            ),
            56 =>
            array(
                'id' => '23',
                'name' => 'view_familly',
            ),
            57 =>
            array(
                'id' => '52',
                'name' => 'view_major_fact',
            ),
            58 =>
            array(
                'id' => '45',
                'name' => 'view_mission',
            ),
            59 =>
            array(
                'id' => '49',
                'name' => 'view_mission_detail',
            ),
            60 =>
            array(
                'id' => '53',
                'name' => 'view_opinion',
            ),
            61 =>
            array(
                'id' => '64',
                'name' => 'view_page_agencies',
            ),
            62 =>
            array(
                'id' => '80',
                'name' => 'view_page_categories',
            ),
            63 =>
            array(
                'id' => '59',
                'name' => 'view_page_control_campaigns',
            ),
            64 =>
            array(
                'id' => '68',
                'name' => 'view_page_control_points',
            ),
            65 =>
            array(
                'id' => '66',
                'name' => 'view_page_domains',
            ),
            66 =>
            array(
                'id' => '63',
                'name' => 'view_page_dres',
            ),
            67 =>
            array(
                'id' => '65',
                'name' => 'view_page_families',
            ),
            68 =>
            array(
                'id' => '70',
                'name' => 'view_page_major_facts',
            ),
            69 =>
            array(
                'id' => '71',
                'name' => 'view_page_mission_details',
            ),
            70 =>
            array(
                'id' => '69',
                'name' => 'view_page_missions',
            ),
            71 =>
            array(
                'id' => '62',
                'name' => 'view_page_permissions',
            ),
            72 =>
            array(
                'id' => '67',
                'name' => 'view_page_processes',
            ),
            73 =>
            array(
                'id' => '61',
                'name' => 'view_page_roles',
            ),
            74 =>
            array(
                'id' => '60',
                'name' => 'view_page_users',
            ),
            75 =>
            array(
                'id' => '12',
                'name' => 'view_permission',
            ),
            76 =>
            array(
                'id' => '32',
                'name' => 'view_process',
            ),
            77 =>
            array(
                'id' => '4',
                'name' => 'view_role',
            ),
            78 =>
            array(
                'id' => '8',
                'name' => 'view_user',
            ),
        ));
    }
}
