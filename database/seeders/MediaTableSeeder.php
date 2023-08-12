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
                'original_name' => 'Encaisse DAB.xlsx',
                'hash_name' => 'xb3c4891SFpgERvHKsoeYTwDiDgm2OYZsWw3X2R9.xlsx',
                'folder' => 'uploads',
                'extension' => 'xlsx',
                'mimetype' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'size' => '24419',
                'attachable_type' => 'App\\Models\\MissionDetail',
                'attachable_id' => '7c572204-8d55-47e4-bd5b-df8bd3d711b4',
                'uploaded_by_id' => 45,
                'created_at' => '2023-07-30 12:06:36',
                'updated_at' => '2023-07-30 12:06:36',
            ),
            1 => 
            array (
                'id' => 2,
                'original_name' => 'Les encaisses .xlsx',
                'hash_name' => 'qIx1KOFXMc3XeNeQOlxzYqAkdZe2QpKogt6OoCSg.xlsx',
                'folder' => 'uploads',
                'extension' => 'xlsx',
                'mimetype' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'size' => '24570',
                'attachable_type' => 'App\\Models\\MissionDetail',
                'attachable_id' => '61534dd6-d343-4fc7-abc2-19dd50e9f625',
                'uploaded_by_id' => 45,
                'created_at' => '2023-07-30 12:09:53',
                'updated_at' => '2023-07-30 12:09:53',
            ),
            2 => 
            array (
                'id' => 3,
                'original_name' => 'Les encaisses .xlsx',
                'hash_name' => 'wQ9YttiLBVzhtC2srdHtgAPkMBJCv39p0rFEg1yz.xlsx',
                'folder' => 'uploads',
                'extension' => 'xlsx',
                'mimetype' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'size' => '24570',
                'attachable_type' => 'App\\Models\\MissionDetail',
                'attachable_id' => '2fe98d6f-13f5-4e83-8685-f1d8dc39a225',
                'uploaded_by_id' => 45,
                'created_at' => '2023-07-30 12:11:41',
                'updated_at' => '2023-07-30 12:11:41',
            ),
            3 => 
            array (
                'id' => 4,
                'original_name' => 'wallpapersden.com_i-love-coding-log_3840x2400.jpg',
                'hash_name' => 'heyzeMduvS52yPCM5lDOjovHQbbhdsWI6u8y8Prw.jpg',
                'folder' => 'uploads',
                'extension' => 'jpg',
                'mimetype' => 'image/jpeg',
                'size' => '166824',
                'attachable_type' => 'App\\Models\\MissionDetail',
                'attachable_id' => 'b1368d0b-73b2-4792-8bb7-1df0477c5fad',
                'uploaded_by_id' => 45,
                'created_at' => '2023-07-30 12:13:42',
                'updated_at' => '2023-07-30 12:13:42',
            ),
            4 => 
            array (
                'id' => 5,
                'original_name' => 'wallpapersden.com_laravel-php-4k_4000x2250.jpg',
                'hash_name' => 'Ipe0IAwgNWaZPJVQ8run1YnZcKKmXaCo4cQTmpdk.jpg',
                'folder' => 'uploads',
                'extension' => 'jpg',
                'mimetype' => 'image/jpeg',
                'size' => '222904',
                'attachable_type' => 'App\\Models\\MissionDetail',
                'attachable_id' => 'b1368d0b-73b2-4792-8bb7-1df0477c5fad',
                'uploaded_by_id' => 45,
                'created_at' => '2023-07-30 12:13:46',
                'updated_at' => '2023-07-30 12:13:46',
            ),
            5 => 
            array (
                'id' => 6,
                'original_name' => 'wallpapersden.com_late-night-coding_10114x5562.jpg',
                'hash_name' => 'M6pkYTKMHndnTyIuLccPWhPsMcthMKQJvnKdpom3.jpg',
                'folder' => 'uploads',
                'extension' => 'jpg',
                'mimetype' => 'image/jpeg',
                'size' => '991887',
                'attachable_type' => 'App\\Models\\MissionDetail',
                'attachable_id' => 'b1368d0b-73b2-4792-8bb7-1df0477c5fad',
                'uploaded_by_id' => 45,
                'created_at' => '2023-07-30 12:13:52',
                'updated_at' => '2023-07-30 12:13:52',
            ),
            6 => 
            array (
                'id' => 7,
                'original_name' => 'wallpapersden.com_programmer-eat-sleep-code-and-repeat_3840x2160.jpg',
                'hash_name' => 'bLCp4bmjoCkaWCiSDndREPfD8uLXjA7ziRt6N3DZ.jpg',
                'folder' => 'uploads',
                'extension' => 'jpg',
                'mimetype' => 'image/jpeg',
                'size' => '161900',
                'attachable_type' => 'App\\Models\\MissionDetail',
                'attachable_id' => 'b1368d0b-73b2-4792-8bb7-1df0477c5fad',
                'uploaded_by_id' => 45,
                'created_at' => '2023-07-30 12:14:01',
                'updated_at' => '2023-07-30 12:14:01',
            ),
        ));
        
        
    }
}