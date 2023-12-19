<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ZipController extends Controller
{
    /**
     * Download generated zip folder
     *
     * @param string $type
     * @param string|int $id
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download(string $type, string|int $id)
    {
        $media = DB::table('has_media as hm')
            ->leftJoin('media as m', 'm.id', 'hm.media_id')
            ->where('attachable_id', $id)
            ->where('attachable_type', 'App\Models\\' . $type)->get();
        if ($type == 'Mission') {
            $mission = getMissions()->where('m.id', $id)->first();
            $details = getMissionDetails()->where('mission_id', $id)->get();
            foreach ($details as $detail) {
                $detailMedia = DB::table('has_media as hm')
                    ->leftJoin('media as m', 'm.id', 'hm.media_id')
                    ->where('attachable_id', $detail->id)
                    ->where('attachable_type', 'App\Models\\MissionDetail')->get();
                if ($detailMedia->count()) {
                    $media = $media->merge($detailMedia);
                }
            }
            $zipName = 'pièces_jointes-' . \Str::slug($mission->reference) . '.zip';
            return $this->generateZip($media, $zipName);
        }
    }

    /**
     * Generate zip folder and add concerned files
     *
     * @param Collection $media
     * @param string $zipName
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    private function generateZip(Collection $media, string $zipName, string $folder = 'zip')
    {
        if ($media->count()) {
            try {
                $zip = new ZipArchive;
                if (!Storage::exists('public/exported/' . $folder)) {
                    Storage::makeDirectory('public/exported/' . $folder);
                }

                if ($zip->open(Storage::path('public/exported/' . $folder . '/' . $zipName), ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE)) {
                    foreach ($media as $file) {
                        $filePath = $file->folder . '/' . $file->hash_name;
                        if (Storage::path($filePath)) {
                            $zip->addFile(Storage::path('public/' . $filePath), $file->original_name);
                        }
                    }
                }
                $zip->close();
                return response()->download(Storage::path('public/exported/' . $folder . '/' . $zipName));
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
        } else {
            abort(404, "Aucune pièce jointe n'a été retrouvée!");
        }
    }
}