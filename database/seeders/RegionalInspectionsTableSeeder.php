<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionalInspectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            DB::table('regional_inspections')->insert([
                ['code' => 141, 'name' => 'IR BLIDA'],
                ['code' => 142, 'name' => 'IR CONSTANTINE'],
                ['code' => 143, 'name' => 'IR ORAN'],
                ['code' => 144, 'name' => 'IR ALGER 1'],
                ['code' => 147, 'name' => 'IR BÉJAIA'],
                ['code' => 148, 'name' => 'IR GRAND SUD'],
                ['code' => 149, 'name' => 'IR ALGER 2'],
                ['code' => 154, 'name' => 'IR SIDI BEL ABBES'],
            ]);

            $irs = [
                DB::table('dres')->select('id')->whereIn('code', [189, 196, 188])->get()->pluck('id')->toArray(),
                DB::table('dres')->select('id')->whereIn('code', [185, 186, 193])->get()->pluck('id')->toArray(),
                DB::table('dres')->select('id')->whereIn('code', [182, 198])->get()->pluck('id')->toArray(),
                DB::table('dres')->select('id')->whereIn('code', [194, 195])->get()->pluck('id')->toArray(),
                DB::table('dres')->select('id')->whereIn('code', [183, 191, 197])->get()->pluck('id')->toArray(),
                DB::table('dres')->select('id')->whereIn('code', [159, 180, 184, 192])->get()->pluck('id')->toArray(),
                DB::table('dres')->select('id')->whereIn('code', [187, 190])->get()->pluck('id')->toArray(),
                DB::table('dres')->select('id')->whereIn('code', [181, 199])->get()->pluck('id')->toArray(),
            ];
            foreach ($irs as $ir => $dres) {
                foreach ($dres as $dre) {
                    DB::table('dres')->where('id', $dre)->update(['ir_id' => $ir + 1]);
                }
            }
        });
    }
}
