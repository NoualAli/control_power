<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
            $this->updateCategories();
            $this->updateFolders();
            $this->removeFolders();
        });
    }

    private function updateCategories()
    {
        $missionOrders = DB::table('media')->where(function ($query) {
            $query->whereLike('folder', '%uploads/Ordres de mission%')->orWhere('folder', 'uploads/mission_order');
        })->update(['category' => 'Ordre de mission']);

        $closingReports = DB::table('media')->where(function ($query) {
            $query->whereLike('folder', '%uploads/Pv de clôture%')->orWhere('folder', 'uploads/closing_report');
        })->update(['category' => 'Pv de clôture']);

        $media = DB::table('media')->whereIn('category', ['Note', 'Lettre-circulaire', 'Circulaire', 'Guide 1er niveau'])->get();
        foreach ($media as $item) {
            $category = '';
            if ($item->category == 'Note') {
                $category = 'Notes';
            } elseif ($item->category == 'Lettre-circulaire') {
                $category = 'Lettres-circulaire';
            } elseif ($item->category == 'Circulaire') {
                $category = 'Circulaires';
            } elseif ($item->category == 'Guide 1er niveau') {
                $category = 'Guides 1er niveau';
            }

            DB::table('media')->where('id', $item->id)->update(['category' => $category]);
        }
    }

    private function updateFolders()
    {
        $missionOrders = DB::table('media')->where(function ($query) {
            $query->whereLike('folder', '%uploads/Ordres de mission%')->orWhere('folder', 'uploads/mission_order');
        })->get();

        foreach ($missionOrders as $mo) {
            $oldPath = 'public/' . $mo->folder . '/' . $mo->hash_name;
            $newPath = 'public/uploads/Ordres de mission/' . $mo->hash_name;
            if (Storage::fileExists($oldPath)) {
                Storage::move($oldPath, $newPath);
            }
            DB::table('media')->where('id', $mo->id)->update(['folder' => 'uploads/Ordres de mission']);
        }

        $closingReports = DB::table('media')->where(function ($query) {
            $query->whereLike('folder', '%uploads/Pv de clôture%')->orWhere('folder', 'uploads/closing_report');
        })->get();

        foreach ($closingReports as $cr) {
            $oldPath = 'public/' . $cr->folder . '/' . $cr->hash_name;
            $newPath = 'public/uploads/PV de clôture/' . $cr->hash_name;
            if (Storage::fileExists($oldPath)) {
                Storage::move($oldPath, $newPath);
            }
            DB::table('media')->where('id', $cr->id)->update(['folder' => 'uploads/PV de clôture']);
        }
    }

    private function removeFolders()
    {
        if (Storage::directoryExists('public/uploads/mission_order')) {
            Storage::deleteDirectory('public/uploads/mission_order');
        }
        if (Storage::directoryExists('public/uploads/closing_report')) {
            Storage::deleteDirectory('public/uploads/closing_report');
        }

        $missionOrders = Storage::directories('public/uploads/Ordres de mission');

        foreach ($missionOrders as $mo) {
            if (Storage::directoryExists($mo)) {
                Storage::deleteDirectory($mo);
            }
        }

        $missionOrders = Storage::directories('public/uploads/PV de clôture');

        foreach ($missionOrders as $mo) {
            if (Storage::directoryExists($mo)) {
                Storage::deleteDirectory($mo);
            }
        }
    }
}
