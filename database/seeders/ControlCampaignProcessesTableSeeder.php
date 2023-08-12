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
                'process_id' => 57,
            ),
            1 => 
            array (
                'id' => 2,
                'control_campaign_id' => 1,
                'process_id' => 58,
            ),
            2 => 
            array (
                'id' => 3,
                'control_campaign_id' => 1,
                'process_id' => 8,
            ),
            3 => 
            array (
                'id' => 4,
                'control_campaign_id' => 1,
                'process_id' => 9,
            ),
            4 => 
            array (
                'id' => 5,
                'control_campaign_id' => 1,
                'process_id' => 7,
            ),
        ));
        
        
    }
}