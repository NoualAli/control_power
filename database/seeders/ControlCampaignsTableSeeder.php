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
                'created_at' => '2023-01-24 11:11:58',
                'created_by_id' => 2,
                'deleted_at' => NULL,
                'description' => 'test',
                'end' => '2023-02-11 00:00:00',
                'id' => 1,
                'reference' => 'CDC-2023-01',
                'start' => '2023-01-26 00:00:00',
                'state' => 'À effectuer',
                'updated_at' => '2023-01-24 11:11:58',
            ),
            1 => 
            array (
                'created_at' => '2023-01-24 11:13:59',
                'created_by_id' => 2,
                'deleted_at' => NULL,
                'description' => 'test',
                'end' => '2023-03-11 00:00:00',
                'id' => 2,
                'reference' => 'CDC-2023-02',
                'start' => '2023-02-11 00:00:00',
                'state' => 'À effectuer',
                'updated_at' => '2023-01-29 10:55:45',
            ),
            2 => 
            array (
                'created_at' => '2023-01-24 11:54:28',
                'created_by_id' => 2,
                'deleted_at' => NULL,
                'description' => 'test',
                'end' => '2023-02-11 00:00:00',
                'id' => 3,
                'reference' => 'CDC-2023-03',
                'start' => '2023-01-30 00:00:00',
                'state' => 'À effectuer',
                'updated_at' => '2023-01-24 11:54:28',
            ),
            3 => 
            array (
                'created_at' => '2023-01-24 11:56:26',
                'created_by_id' => 2,
                'deleted_at' => NULL,
                'description' => 'test',
                'end' => '2023-02-11 00:00:00',
                'id' => 4,
                'reference' => 'CDC-2023-04',
                'start' => '2023-01-26 00:00:00',
                'state' => 'À effectuer',
                'updated_at' => '2023-01-24 11:56:26',
            ),
            4 => 
            array (
                'created_at' => '2023-01-24 15:17:27',
                'created_by_id' => 2,
                'deleted_at' => NULL,
                'description' => 'test',
                'end' => '2023-02-04 00:00:00',
                'id' => 5,
                'reference' => 'CDC-2023-05',
                'start' => '2023-01-25 00:00:00',
                'state' => 'À effectuer',
                'updated_at' => '2023-01-24 15:17:27',
            ),
        ));
        
        
    }
}