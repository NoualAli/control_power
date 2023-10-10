<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ControlCampaignsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('control_campaigns')->delete();
        
        \DB::table('control_campaigns')->insert(array (
            0 => 
            array (
                'id' => '1',
                'description' => '<p>test</p>',
                'reference' => 'CDC-2023-01',
                'created_by_id' => '4',
                'validated_by_id' => '4',
                'validated_at' => '2023-09-18 15:34:22.4470000',
                'start_date' => '2023-09-18 00:00:00.0000000',
                'end_date' => '2023-09-21 00:00:00.0000000',
                'created_at' => '2023-09-18 15:34:22.4540000',
                'updated_at' => '2023-09-18 15:34:22.4540000',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}