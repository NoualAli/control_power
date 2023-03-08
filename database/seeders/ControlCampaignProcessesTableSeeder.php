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
                'control_campaign_id' => 1,
                'id' => 1,
                'process_id' => 517,
            ),
            1 => 
            array (
                'control_campaign_id' => 1,
                'id' => 2,
                'process_id' => 518,
            ),
            2 => 
            array (
                'control_campaign_id' => 2,
                'id' => 3,
                'process_id' => 517,
            ),
            3 => 
            array (
                'control_campaign_id' => 2,
                'id' => 4,
                'process_id' => 518,
            ),
        ));
        
        
    }
}