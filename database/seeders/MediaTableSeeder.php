<?php

namespace Database\Seeders;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MediaTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $media = DB::table('media')->select('attachable_id', 'attachable_type', 'id')->get();
            $totalMedia = $media->count();
            $totalNewMediaInserted = 0;

            foreach ($media as $file) {
                $inseted = DB::table('has_media')->insert([
                    'attachable_id' => $file->attachable_id,
                    'attachable_type' => $file->attachable_type,
                    'media_id' => $file->id
                ]);

                if ($inseted) {
                    $totalNewMediaInserted += 1;
                }
            }

            if ($totalMedia == $totalNewMediaInserted) {
                Schema::table('media', function (Blueprint $table) {
                    $table->dropColumn('attachable_id');
                    $table->dropColumn('attachable_type');
                });
            }
        });
    }
}
