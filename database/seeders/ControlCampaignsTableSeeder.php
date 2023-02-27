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
                'id' => 1,
                'description' => 'test',
                'start' => '2023-01-26 00:00:00',
                'end' => '2023-02-11 00:00:00',
                'created_by_id' => 2,
                'reference' => 'CDC-2023-01',
                'state' => 'À effectuer',
                'created_at' => '2023-01-24 11:11:58',
                'updated_at' => '2023-01-24 11:11:58',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'description' => 'test',
                'start' => '2023-02-11 00:00:00',
                'end' => '2023-03-11 00:00:00',
                'created_by_id' => 2,
                'reference' => 'CDC-2023-02',
                'state' => 'À effectuer',
                'created_at' => '2023-01-24 11:13:59',
                'updated_at' => '2023-01-29 10:55:45',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'description' => 'test',
                'start' => '2023-01-30 00:00:00',
                'end' => '2023-02-11 00:00:00',
                'created_by_id' => 2,
                'reference' => 'CDC-2023-03',
                'state' => 'À effectuer',
                'created_at' => '2023-01-24 11:54:28',
                'updated_at' => '2023-01-24 11:54:28',
                'deleted_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'description' => 'test',
                'start' => '2023-01-26 00:00:00',
                'end' => '2023-02-11 00:00:00',
                'created_by_id' => 2,
                'reference' => 'CDC-2023-04',
                'state' => 'À effectuer',
                'created_at' => '2023-01-24 11:56:26',
                'updated_at' => '2023-01-24 11:56:26',
                'deleted_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'description' => 'test',
                'start' => '2023-01-25 00:00:00',
                'end' => '2023-02-04 00:00:00',
                'created_by_id' => 2,
                'reference' => 'CDC-2023-05',
                'state' => 'À effectuer',
                'created_at' => '2023-01-24 15:17:27',
                'updated_at' => '2023-01-24 15:17:27',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}