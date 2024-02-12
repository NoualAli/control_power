<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
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
        $method = 'generate' . $type . 'Zip';
        if (method_exists($this, $method)) {
            return $this->$method($type, $id);
        } else {
            abort(404, "Le type $type n'est pas pris en charge");
        }
    }

    function generateMissionZip(string $type, string $id)
    {
        $media = $this->getMedia($type, $id)->get();
        $mission = getMissions()->where('m.id', $id)->first();
        $details = getMissionDetails()->where('md.mission_id', $id)->get();
        foreach ($details as $detail) {
            $detailMedia = $this->getMedia('MissionDetail', $detail->id)->get();
            if ($detailMedia->count()) {
                $media = $media->merge($detailMedia);
            }
        }
        $zipName = $this->generateZipName($mission->reference);
        return $this->generateZip($media, $zipName, 'missions');
    }

    function generateControlCampaignZip(string $type, string $id)
    {
        $campaign = getControlCampaigns(null, $id);
        $missions = getMissions()->select('m.id')->where('cc.id', $id)->get()->pluck('id');
        $media = collect([]);
        foreach ($missions as $mission) {
            $missionMedia = $this->getMedia('Mission', $mission)->get();
            $media->push($missionMedia);
        }
        $zipName = $this->generateZipName($campaign->reference);
        return $this->generateZip($media->flatten(), $zipName, 'campaigns');
    }

    /**
     * Generate zip folder and add concerned files
     *
     * @param Collection $media
     * @param string $zipName
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    private function generateZip(Collection $media, string $zipName, string $folder = '')
    {
        if ($media->count()) {
            try {
                $zip = new ZipArchive;
                $rootFolder = 'public/exported/zip/';
                $folder = $rootFolder . $folder;
                if (!Storage::exists($folder)) {
                    Storage::makeDirectory($folder);
                }

                if ($zip->open(Storage::path($folder . '/' . $zipName), ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE)) {
                    foreach ($media as $file) {
                        $filePath = $file->folder . '/' . $file->hash_name;
                        if (Storage::exists('public/' . $filePath)) {
                            $patterns = ['/uploads\//', '/exported\\\campaigns\\\/', '/\\\missions/'];
                            $fileFolder = preg_replace($patterns, '', $file->folder);
                            $fileFolder = str_replace('closing_report', 'PV de clôture', $fileFolder);
                            $fileFolder = str_replace('mission_order', 'Ordres de mission', $fileFolder);
                            $zip->addFile(Storage::path('public/' . $filePath), $fileFolder . '/' . $file->original_name);
                        }
                    }
                }
                $zip->close();
                return response()->download(Storage::path($folder . '/' . $zipName));
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
        } else {
            abort(404, "Aucune pièce jointe n'a été retrouvée!");
        }
    }

    /**
     * @param string $name
     *
     * @return string
     */
    private function generateZipName(string $name): string
    {
        return 'pièces_jointes-' . Str::slug($name) . '.zip';
    }

    /**
     * @param string $type
     * @param string $id
     *
     * @return Builder
     */
    private function getMedia(string $type, string $id): Builder
    {
        return DB::table('has_media as hm')
            ->leftJoin('media as m', 'm.id', 'hm.media_id')
            ->where('attachable_id', $id)
            ->where('attachable_type', 'App\Models\\' . $type);
    }
}
