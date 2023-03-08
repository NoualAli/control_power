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
                'attachable_id' => '00fcb4c5-7c42-40c2-8f0c-42f1b7f7ddd1',
                'attachable_type' => 'App\\Models\\MissionDetail',
                'created_at' => '2023-03-04 17:12:13',
                'extension' => 'png',
                'folder' => 'uploads',
                'hash_name' => 'KVYMUhnsZO2gDKeCJ2qX8QTkY68dGm08A8GN1ZIP.png',
                'id' => 1,
                'mimetype' => 'image/png',
                'original_name' => 'power_control_db_diagram.png',
                'size' => '233338',
                'updated_at' => '2023-03-04 17:12:13',
            ),
            1 => 
            array (
                'attachable_id' => '355ece57-eef7-4667-b634-8dc7263e6838',
                'attachable_type' => 'App\\Models\\MissionDetail',
                'created_at' => '2023-03-04 18:09:07',
                'extension' => 'png',
                'folder' => 'uploads',
                'hash_name' => 'W1Ccp6Wo0yWk3UYevsFDHroBz8qYikvYvYbBjfKc.png',
                'id' => 2,
                'mimetype' => 'image/png',
                'original_name' => 'Capture d’écran du 2023-02-19 22-31-44.png',
                'size' => '49341',
                'updated_at' => '2023-03-04 18:09:07',
            ),
            2 => 
            array (
                'attachable_id' => '355ece57-eef7-4667-b634-8dc7263e6838',
                'attachable_type' => 'App\\Models\\MissionDetail',
                'created_at' => '2023-03-04 18:09:07',
                'extension' => 'png',
                'folder' => 'uploads',
                'hash_name' => 'nxwsFrOWCRbxeMiDcxYuI8KzJNdzbmWfwLUj3PQY.png',
                'id' => 3,
                'mimetype' => 'image/png',
                'original_name' => 'Capture d’écran du 2023-02-19 22-28-35.png',
                'size' => '42439',
                'updated_at' => '2023-03-04 18:09:07',
            ),
            3 => 
            array (
                'attachable_id' => '355ece57-eef7-4667-b634-8dc7263e6838',
                'attachable_type' => 'App\\Models\\MissionDetail',
                'created_at' => '2023-03-04 18:09:07',
                'extension' => 'png',
                'folder' => 'uploads',
                'hash_name' => 'CEbX7yok2gNkHjdeJxVFQ6wo7YSUwoR42ZtlVg7O.png',
                'id' => 4,
                'mimetype' => 'image/png',
                'original_name' => 'Capture d’écran du 2023-02-19 22-26-04.png',
                'size' => '46186',
                'updated_at' => '2023-03-04 18:09:07',
            ),
        ));
        
        
    }
}