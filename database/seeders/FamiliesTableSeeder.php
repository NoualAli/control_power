<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FamiliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('families')->update(['usable_for_agency' => true]);
        // DB::table('families')->insert([
        //     ['code' => 'DGAB', 'name' => 'DGAB', 'usable_for_dre' => true, 'usable_for_agency' => false],
        // ]);

        $families = getFamilies()->get();
        foreach ($families as $familyKey => $family) {
            DB::table('families')->where('id', $family->id)->where('usable_for_dre', false)->update(['display_priority' => $familyKey + 1, 'usable_for_agency' => true, 'is_active' => true, 'updated_at' => now()]);
            DB::table('families')->where('id', $family->id)->where('usable_for_agency', false)->update(['display_priority' => $familyKey + 1, 'usable_for_dre' => true, 'is_active' => true, 'updated_at' => now()]);
            $domains = getDomains()->where('family_id', $family->id)->get();
            foreach ($domains as $domainKey => $domain) {
                DB::table('domains')->where('id', $domain->id)->where('usable_for_dre', false)->update(['display_priority' => $domainKey + 1, 'usable_for_agency' => true, 'is_active' => true, 'updated_at' => now()]);
                DB::table('domains')->where('id', $domain->id)->where('usable_for_agency', false)->update(['display_priority' => $domainKey + 1, 'usable_for_dre' => true, 'is_active' => true, 'updated_at' => now()]);
                $processes = getProcesses()->where('domain_id', $domain->id)->get();
                foreach ($processes as $processKey => $process) {
                    DB::table('processes')->where('id', $process->id)->where('usable_for_dre', false)->update(['display_priority' => $processKey + 1, 'usable_for_agency' => true, 'is_active' => true, 'updated_at' => now()]);
                    DB::table('processes')->where('id', $process->id)->where('usable_for_agency', false)->update(['display_priority' => $processKey + 1, 'usable_for_dre' => true, 'is_active' => true, 'updated_at' => now()]);
                    $control_points = DB::table('control_points')->where('process_id', $process->id)->get();
                    foreach ($control_points as $cpKey => $control_point) {
                        DB::table('control_points')->where('id', $control_point->id)->where('usable_for_dre', false)->update(['display_priority' => $cpKey + 1, 'usable_for_agency' => true, 'is_active' => true, 'updated_at' => now()]);
                        DB::table('control_points')->where('id', $control_point->id)->where('usable_for_agency', false)->update(['display_priority' => $cpKey + 1, 'usable_for_dre' => true, 'is_active' => true, 'updated_at' => now()]);
                    }
                }
            }
        }
    }
}