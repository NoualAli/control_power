<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MediaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('media')->delete();
        
        \DB::table('media')->insert(array (
            0 => 
            array (
                'id' => 1,
                'original_name' => 'power_control_db_diagram.png',
                'hash_name' => '56Z46wl4IlNtaoIGvObj9EVnZJkL5XW0Rf3CKCXq.png',
                'folder' => 'uploads',
                'extension' => 'png',
                'mimetype' => 'image/png',
                'size' => '259478',
                'attachable_type' => 'App\\Models\\MissionDetail',
                'attachable_id' => 'b4a6aeb9-c989-47f2-9704-647af476edf5',
                'created_at' => '2023-02-21 10:03:26',
                'updated_at' => '2023-02-21 10:03:26',
            ),
        ));
        
        
    }
}