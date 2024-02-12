<?php

namespace Database\Seeders;

use App\Models\Mission;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $missions = getMissions()->addSelect(['ci_validation_at', 'ci_validation_by_id', 'm.created_by_id', 'm.cdc_validation_by_id', 'm.cdcr_validation_by_id', 'm.dcp_validation_by_id', 'm.da_validation_by_id'])
                ->groupBy('m.created_by_id', 'm.cdc_validation_by_id', 'm.cdcr_validation_by_id', 'm.dcp_validation_by_id', 'm.da_validation_by_id')->get();
            $results = collect([]);
            foreach ($missions as $mission) {
                $missionFirstDetailControlled = getMissionDetails($mission->id)->select(['controlled_by_ci_at'])->orderBy('controlled_by_ci_at')->first()?->controlled_by_ci_at;
                $missionRealEnd = $mission->ci_validation_at;
                $result = DB::table('missions')->where('id', $mission->id)->update([
                    'assigned_to_ci_id' => $mission->ci_validation_by_id,
                    'real_start' => $missionFirstDetailControlled,
                    'real_end' => $missionRealEnd,
                    'creator_full_name' => $mission->created_by_id ? getUserFullNameWithRole($mission->created_by_id) : null,
                    'cdc_validator_full_name' => $mission->cdc_validation_by_id ? getUserFullNameWithRole($mission->cdc_validation_by_id) : null,
                    'cdcr_validator_full_name' => $mission->cdcr_validation_by_id ? getUserFullNameWithRole($mission->cdcr_validation_by_id) : null,
                    'dcp_validator_full_name' => $mission->dcp_validation_by_id ? getUserFullNameWithRole($mission->dcp_validation_by_id) : null,
                    'da_validator_full_name' => $mission->da_validation_by_id ? getUserFullNameWithRole($mission->da_validation_by_id) : null,
                ]);

                $results->push(['reference' => $mission->reference, 'status' => $result]);
            }
            if ($results->contains('status', 0)) {
                dd($results->pluck('reference')->join(', '));
            }

            Schema::table('missions', function (Blueprint $table) {
                $table->dropColumn('reel_end');
                $table->dropColumn('reel_start');
            });
            // Check if the table exists before dropping it
            if (Schema::hasTable('mission_has_controllers')) {
                DB::table('mission_has_controllers')->delete();
                Schema::dropColumns('mission_has_controllers', 'control_agency');
            }
        });
    }
}