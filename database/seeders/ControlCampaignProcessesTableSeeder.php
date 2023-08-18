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
                'control_campaign_id' => '1',
                'process_id' => '57',
            ),
            1 => 
            array (
                'control_campaign_id' => '1',
                'process_id' => '58',
            ),
            2 => 
            array (
                'control_campaign_id' => '1',
                'process_id' => '8',
            ),
            3 => 
            array (
                'control_campaign_id' => '1',
                'process_id' => '9',
            ),
            4 => 
            array (
                'control_campaign_id' => '1',
                'process_id' => '7',
            ),
            5 => 
            array (
                'control_campaign_id' => '2',
                'process_id' => '57',
            ),
            6 => 
            array (
                'control_campaign_id' => '2',
                'process_id' => '58',
            ),
        ));
        
        
    }
}