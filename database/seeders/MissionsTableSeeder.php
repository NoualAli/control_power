<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('missions')->delete();
        
        \DB::table('missions')->insert(array (
            0 => 
            array (
                'agency_id' => 104,
                'cdcr_validation_at' => NULL,
                'cdcr_validation_by_id' => NULL,
                'control_campaign_id' => 2,
                'created_at' => '2023-03-04 17:08:09',
                'created_by_id' => 5,
                'dcp_validation_at' => NULL,
                'dcp_validation_by_id' => NULL,
                'deleted_at' => NULL,
                'end' => '2023-03-30 00:00:00',
                'id' => '4a399675-dd14-4868-b727-183ef3525b9f',
                'note' => NULL,
                'reference' => 'RAP202302/613',
                'start' => '2023-03-04 00:00:00',
                'updated_at' => '2023-03-04 17:08:09',
            ),
        ));
        
        
    }
}