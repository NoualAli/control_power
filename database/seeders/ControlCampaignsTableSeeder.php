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
                'created_at' => '2023-03-04 16:57:53',
                'created_by_id' => 2,
                'deleted_at' => NULL,
                'description' => 'test',
                'end' => '2023-03-30 00:00:00',
                'id' => 1,
                'reference' => 'CDC-2023-01',
                'start' => '2023-03-10 00:00:00',
                'state' => 'À effectuer',
                'updated_at' => '2023-03-04 17:05:08',
                'validated_at' => '2023-03-04 17:05:08',
                'validated_by_id' => 2,
            ),
            1 => 
            array (
                'created_at' => '2023-03-04 17:03:34',
                'created_by_id' => 2,
                'deleted_at' => NULL,
                'description' => 'test',
                'end' => '2023-03-30 00:00:00',
                'id' => 2,
                'reference' => 'CDC-2023-02',
                'start' => '2023-03-03 00:00:00',
                'state' => 'À effectuer',
                'updated_at' => '2023-03-04 17:03:51',
                'validated_at' => '2023-03-04 17:03:51',
                'validated_by_id' => 2,
            ),
        ));
        
        
    }
}