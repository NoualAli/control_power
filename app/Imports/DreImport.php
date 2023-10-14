<?php

namespace App\Imports;

use App\Models\Dre;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DreImport implements ToModel, WithHeadingRow
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
                $dre = [
                    'code' => $row['code'],
                    'name' => $row['name'],
                ];
                $dreExists = Dre::where('code', $dre['code'])->where('name', $dre['name'])->count();
                if (!$dreExists) {
                    return Dre::create($dre);
                }
            });
        } catch (\Throwable $th) {
            dd($th->getMessage(), $th->getLine(), $row);
        }
    }
}
