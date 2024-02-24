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
            $this->updateMediaType();
            $this->updateRelationIds();
            $this->removeWithoutRelations();
        });
    }

    private function removeWithoutRelations()
    {
        $withoutRelationships = DB::table('media AS m')
            ->leftJoin('has_media AS hm', 'hm.media_id', '=', 'm.id')
            ->whereNull('hm.media_id')
            ->whereIn('m.folder', [
                'references\Note',
                'references\Lettre-circulaire',
                'references\Circulaire',
                'references\Guide 1er niveau'
            ])
            ->get();
        foreach ($withoutRelationships as $file) {
            $path = storage_path('app\\public\\' . $file->folder . '\\' . $file->hash_name);
            $result = DB::table('media')->where('id', $file->id)->delete();
            if (file_exists($path) && $result) {
                unlink($path);
            }
            // Circulaire => 207 - 137 = 70
            // Guide 1er niveau => 142 - 93 = 49
            // Lettre-circulaire => 27 - 21 = 6
            // Note => 108 - 93 = 15
            // Total removed = 140
        }
    }

    private function updateRelationIds()
    {
        $media = DB::table('media')
            ->select([
                DB::raw('MIN(id) as id'),
                'original_name',
                'payload',
                'folder'
            ])
            ->whereIn('folder', [
                'references\Note',
                'references\Lettre-circulaire',
                'references\Circulaire',
                'references\Guide 1er niveau'
            ])
            ->groupBy('original_name', 'payload', 'folder')
            ->get();


        foreach ($media as $file) {
            $payload = json_encode(json_decode(json_decode($file->payload)));
            DB::table('media')->where('id', $file->id)->update(['payload' => $payload]);
            DB::table('has_media AS hm')
                ->leftJoin('media AS m', 'm.id', '=', 'hm.media_id')
                ->whereIn('folder', [
                    'references\Note',
                    'references\Lettre-circulaire',
                    'references\Circulaire',
                    'references\Guide 1er niveau'
                ])
                ->where('original_name', $file->original_name)->update(['media_id' => $file->id]);
        }
    }

    private function updateMediaType()
    {
        $media = DB::table('media')
            ->select(['original_name', 'payload', 'folder'])
            ->whereIn('folder', [
                'references\Note',
                'references\Lettre-circulaire',
                'references\Circulaire',
                'references\Guide 1er niveau'
            ])
            ->groupBy('original_name', 'payload', 'folder')->get();
        foreach ($media as $file) {
            $category = null;
            if ($file->folder == 'references\Note') {
                $category = 'Note';
            } elseif ($file->folder == 'references\Lettre-circulaire') {
                $category = 'Lettre-circulaire';
            } elseif ($file->folder == 'references\Circulaire') {
                $category = 'Circulaire';
            } elseif ($file->folder == 'references\Guide 1er niveau') {
                $category = 'Guide 1er niveau';
            }
            DB::table('media')->where('original_name', $file->original_name)->update(['category' => $category]);
        }
    }
}