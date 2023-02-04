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
                'id' => '25222f9d-cd36-4b05-8877-b4d2b1e0aa6b',
                'reference' => 'RAP202302/612',
                'note' => NULL,
                'control_campaign_id' => 2,
                'agency_id' => 103,
                'created_by_id' => 10,
                'start' => '2023-01-29 00:00:00',
                'end' => '2023-02-02 00:00:00',
                'created_at' => '2023-01-29 11:00:08',
                'updated_at' => '2023-01-29 11:00:08',
                'deleted_at' => NULL,
            ),
            1 => 
            array (
                'id' => 'a480f9e4-7752-41d1-8654-ffca1fe2fac7',
                'reference' => 'RAP202305/612',
                'note' => 'test',
                'control_campaign_id' => 5,
                'agency_id' => 103,
                'created_by_id' => 10,
                'start' => '2023-02-11 00:00:00',
                'end' => '2023-03-04 00:00:00',
                'created_at' => '2023-01-27 12:27:30',
                'updated_at' => '2023-01-27 20:48:06',
                'deleted_at' => NULL,
            ),
            2 => 
            array (
                'id' => 'b0638002-dc07-45b4-a9c8-f9b67d62c348',
                'reference' => 'RAP202305/613',
                'note' => 'test',
                'control_campaign_id' => 5,
                'agency_id' => 104,
                'created_by_id' => 10,
                'start' => '2023-01-28 00:00:00',
                'end' => '2023-02-08 00:00:00',
                'created_at' => '2023-01-27 12:27:30',
                'updated_at' => '2023-01-27 18:59:24',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}