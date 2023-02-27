<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ControlCampaignProcessesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('control_campaign_processes')->delete();
        
        \DB::table('control_campaign_processes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'control_campaign_id' => 1,
                'process_id' => 51,
            ),
            1 => 
            array (
                'id' => 2,
                'control_campaign_id' => 1,
                'process_id' => 52,
            ),
            2 => 
            array (
                'id' => 3,
                'control_campaign_id' => 1,
                'process_id' => 50,
            ),
            3 => 
            array (
                'id' => 10,
                'control_campaign_id' => 3,
                'process_id' => 55,
            ),
            4 => 
            array (
                'id' => 11,
                'control_campaign_id' => 3,
                'process_id' => 57,
            ),
            5 => 
            array (
                'id' => 12,
                'control_campaign_id' => 3,
                'process_id' => 58,
            ),
            6 => 
            array (
                'id' => 13,
                'control_campaign_id' => 3,
                'process_id' => 59,
            ),
            7 => 
            array (
                'id' => 14,
                'control_campaign_id' => 3,
                'process_id' => 60,
            ),
            8 => 
            array (
                'id' => 15,
                'control_campaign_id' => 4,
                'process_id' => 123,
            ),
            9 => 
            array (
                'id' => 16,
                'control_campaign_id' => 4,
                'process_id' => 124,
            ),
            10 => 
            array (
                'id' => 17,
                'control_campaign_id' => 5,
                'process_id' => 1,
            ),
            11 => 
            array (
                'id' => 18,
                'control_campaign_id' => 5,
                'process_id' => 2,
            ),
            12 => 
            array (
                'id' => 19,
                'control_campaign_id' => 5,
                'process_id' => 3,
            ),
            13 => 
            array (
                'id' => 20,
                'control_campaign_id' => 5,
                'process_id' => 4,
            ),
            14 => 
            array (
                'id' => 21,
                'control_campaign_id' => 5,
                'process_id' => 62,
            ),
            15 => 
            array (
                'id' => 22,
                'control_campaign_id' => 5,
                'process_id' => 63,
            ),
            16 => 
            array (
                'id' => 23,
                'control_campaign_id' => 5,
                'process_id' => 64,
            ),
            17 => 
            array (
                'id' => 24,
                'control_campaign_id' => 5,
                'process_id' => 65,
            ),
            18 => 
            array (
                'id' => 25,
                'control_campaign_id' => 5,
                'process_id' => 66,
            ),
            19 => 
            array (
                'id' => 26,
                'control_campaign_id' => 5,
                'process_id' => 67,
            ),
            20 => 
            array (
                'id' => 27,
                'control_campaign_id' => 5,
                'process_id' => 68,
            ),
            21 => 
            array (
                'id' => 28,
                'control_campaign_id' => 5,
                'process_id' => 123,
            ),
            22 => 
            array (
                'id' => 29,
                'control_campaign_id' => 5,
                'process_id' => 124,
            ),
            23 => 
            array (
                'id' => 30,
                'control_campaign_id' => 2,
                'process_id' => 21,
            ),
            24 => 
            array (
                'id' => 31,
                'control_campaign_id' => 2,
                'process_id' => 22,
            ),
            25 => 
            array (
                'id' => 32,
                'control_campaign_id' => 2,
                'process_id' => 23,
            ),
            26 => 
            array (
                'id' => 33,
                'control_campaign_id' => 2,
                'process_id' => 24,
            ),
            27 => 
            array (
                'id' => 34,
                'control_campaign_id' => 2,
                'process_id' => 25,
            ),
            28 => 
            array (
                'id' => 35,
                'control_campaign_id' => 2,
                'process_id' => 26,
            ),
            29 => 
            array (
                'id' => 36,
                'control_campaign_id' => 2,
                'process_id' => 27,
            ),
            30 => 
            array (
                'id' => 37,
                'control_campaign_id' => 2,
                'process_id' => 28,
            ),
            31 => 
            array (
                'id' => 38,
                'control_campaign_id' => 2,
                'process_id' => 29,
            ),
            32 => 
            array (
                'id' => 39,
                'control_campaign_id' => 2,
                'process_id' => 30,
            ),
        ));
        
        
    }
}