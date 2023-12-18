<?php

namespace Database\Seeders;

use App\Models\Mission;
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
            $missions = getMissions()->get();
            $results = collect([]);
            foreach ($missions as $mission) {
                $missionFirstDetailControlled = getMissionDetails($mission->id)->select(['controlled_by_ci_at'])->orderBy('controlled_by_ci_at')->first()?->controlled_by_ci_at;
                $result = DB::table('missions')->where('id', $mission->id)->update([
                    'real_start' => $missionFirstDetailControlled,
                    'real_end' => $mission->end_date
                ]);

                $results->push(['reference' => $mission->reference, 'status' => $result]);
            }
            if ($results->contains('status', 0)) {
                dd($results->pluck('reference')->join(', '));
            }

            $missions = DB::table('missions as m')
                ->select([
                    'm.id',
                    'm.reference',
                    DB::raw("CONCAT(cdc.first_name, ' ', cdc.last_name) AS fk_cdc_validator_full_name"),
                    DB::raw("CONCAT(cdcr.first_name, ' ', cdcr.last_name) AS fk_cdcr_validator_full_name"),
                    DB::raw("CONCAT(dcp.first_name, ' ', dcp.last_name) AS fk_dcp_validator_full_name"),
                    DB::raw("CONCAT(da.first_name, ' ', da.last_name) AS fk_da_validator_full_name"),
                    DB::raw("CONCAT(cr.first_name, ' ', cr.last_name) AS fk_creator_full_name"),
                ])
                ->leftJoin('users as cr', 'cr.id', 'm.created_by_id')
                ->leftJoin('users as da', 'da.id', 'm.da_validation_by_id')
                ->leftJoin('users as dcp', 'dcp.id', 'm.dcp_validation_by_id')
                ->leftJoin('users as cdcr', 'cdcr.id', 'm.cdcr_validation_by_id')
                ->leftJoin('users as cdc', 'cdc.id', 'm.cdc_validation_by_id')
                ->where('m.level', 2);

            $missions = $missions->groupBy(
                'm.id',
                'm.reference',
                'cdc.last_name',
                'cdc.first_name',
                'cdcr.last_name',
                'cdcr.first_name',
                'dcp.last_name',
                'dcp.first_name',
                'da.last_name',
                'da.first_name',
                'cr.last_name',
                'cr.first_name',
            );
            $missions = $missions->get();
            foreach ($missions as $mission) {
                DB::table('missions')->where('id', $mission->id)->update([
                    'cdc_validator_full_name' => $mission->fk_cdc_validator_full_name,
                    'cdcr_validator_full_name' => $mission->fk_cdcr_validator_full_name,
                    'dcp_validator_full_name' => $mission->fk_dcp_validator_full_name,
                    'da_validator_full_name' => strlen($mission->fk_da_validator_full_name) ? $mission->fk_da_validator_full_name : NULL,
                    'creator_full_name' => $mission->fk_creator_full_name,
                ]);
            }
        });
    }
}