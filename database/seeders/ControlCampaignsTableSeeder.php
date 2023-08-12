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
                'description' => '<p class="ql-align-justify"><strong>Lorem Ipsum</strong>&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>',
                'reference' => 'CDC-2023-01',
                'created_by_id' => 2,
                'validated_by_id' => 2,
                'validated_at' => '2023-07-30 11:48:31',
                'start' => '2023-07-30 00:00:00',
                'end' => '2023-08-03 00:00:00',
                'created_at' => '2023-07-30 11:48:31',
                'updated_at' => '2023-07-30 11:48:31',
                'deleted_at' => NULL,
            ),
        ));
        
        
    }
}