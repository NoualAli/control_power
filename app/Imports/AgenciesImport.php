<?php

namespace App\Imports;

use App\Models\Agency;
use App\Models\Category;
use App\Models\Dre;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AgenciesImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        try {
            DB::transaction(function ()  use ($row) {
                $dre = Dre::where('code', trim($row['code_dre']))->where('name', trim($row['name_dre']))->first();
                $category = Category::where('name', trim($row['category']))->first();
                // dd($dre->id, $category->id);
                $agency = [
                    'code' => (int) trim($row['code_agence']),
                    'name' => (string) trim($row['name_agence']),
                    'dre_id' => (int) $dre->id,
                    'category_id' => (int) $category->id,
                ];
                $agencyExists = Agency::where('code', $agency['code'])->where('name', $agency['name'])->count();
                if (!$agencyExists) {
                    return Agency::create($agency);
                }
            });
        } catch (\Throwable $th) {
            dd($th->getMessage(), $th->getLine(), $row);
        }
    }
}
