<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MissionReportsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('mission_reports')->delete();
        
        \DB::table('mission_reports')->insert(array (
            0 => 
            array (
                'content' => '<p>rapport test 2</p>',
                'created_at' => '2023-03-04 18:34:25',
                'created_by_id' => 5,
                'deleted_at' => NULL,
                'id' => '0efdfe7f-7927-4667-8681-99e1a9f1516c',
                'mission_id' => '4a399675-dd14-4868-b727-183ef3525b9f',
                'type' => 'Rapport',
                'updated_at' => '2023-03-04 19:19:50',
                'validated_at' => '2023-03-04 19:19:50',
            ),
            1 => 
            array (
                'content' => '<p>test edited</p>',
                'created_at' => '2023-03-04 18:31:18',
                'created_by_id' => 9,
                'deleted_at' => NULL,
                'id' => '409d9e9c-d2b5-4478-ba1c-375d58c3b3dc',
                'mission_id' => '4a399675-dd14-4868-b727-183ef3525b9f',
                'type' => 'Avis contrôleur',
                'updated_at' => '2023-03-04 18:32:48',
                'validated_at' => '2023-03-04 18:32:48',
            ),
        ));
        
        
    }
}