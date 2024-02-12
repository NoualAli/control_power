<?php

namespace Database\Seeders;

use App\Models\Mission;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

            $missions = Mission::all();

            foreach ($missions as $mission) {
                $reportExists = Storage::fileExists('public\exported\campaigns\\' . $mission->campaign->reference . '\\missions\\' . $mission->report_name . '.pdf');
                $id = Str::uuid();
                if ($reportExists) {
                    $insertedFile = DB::table('media')->insert([
                        'id' => $id,
                        'original_name' => $mission->report_name . '.pdf',
                        'hash_name' => $mission->report_name . '.pdf',
                        'folder' => 'exported\campaigns\\' . $mission->campaign->reference . '\\missions',
                        'extension' => 'pdf',
                        'mimetype' => 'application/pd',
                        'size' => Storage::fileSize('public\exported\campaigns\\' . $mission->campaign->reference . '\\missions\\' . $mission->report_name . '.pdf'),
                        'created_at' => now(),
                        'payload' => json_encode([
                            'name' => $mission->reference,
                        ]),
                    ]);
                    $media = DB::table('has_media')->insert([
                        'attachable_id' => $mission->id,
                        'attachable_type' => Mission::class,
                        'media_id' => $id,
                    ]);
                }
            }
        });
    }
}
