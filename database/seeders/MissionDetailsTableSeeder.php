<?php

namespace Database\Seeders;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MissionDetailsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            $majorFactDispatchedAtQuery = DB::table('mission_details')->whereNotNull('major_fact_dispatched_at')->orWhereNotNull('major_fact_dispatched_to_dcp_at')->orWhereNotNull('major_fact_detected_at');
            $majorFactDispatchedAt = $majorFactDispatchedAtQuery->get();

            foreach ($majorFactDispatchedAt as $majorFact) {
                $majorFactDispatchedAtQuery->update([
                    'major_fact_is_dispatched_at' => $majorFact->major_fact_dispatched_at,
                    'major_fact_is_dispatched_to_dcp_at' => $majorFact->major_fact_dispatched_to_dcp_at,
                    'major_fact_is_detected_at' => $majorFact->major_fact_detected_at,
                ]);
            }

            Schema::table('mission_details', function (Blueprint $table) {
                $table->dropColumn('major_fact_dispatched_at');
                $table->dropColumn('major_fact_dispatched_to_dcp_at');
                $table->dropColumn('major_fact_detected_at');
            });

            /**
             * cdc_full_name -> get it from controlled_by_cdc_id
             * cdcr_full_name -> get it from controlled_by_cdcr_id
             * dcp_full_name -> get it from controlled_by_dcp_id
             * major_fact_is_detected_by_full_name -> get it from controlled_by_ci_id
             * major_fact_is_detected_by_id -> get it from controlled_by_ci_id
             */

            $details = DB::table('mission_details as md')->select([
                'md.id',
                'md.major_fact',
                DB::raw("CONCAT(cdc.first_name, ' ', cdc.last_name) AS fk_cdc_validator_full_name"),
                DB::raw("CONCAT(cdcr.first_name, ' ', cdcr.last_name) AS fk_cdcr_validator_full_name"),
                DB::raw("CONCAT(dcp.first_name, ' ', dcp.last_name) AS fk_dcp_validator_full_name"),
                DB::raw("CONCAT(mde.first_name, ' ', mde.last_name) AS fk_md_validator_full_name"),
                'md.controlled_by_ci_id',
                'md.controlled_by_ci_at',
            ])
                ->leftJoin('users as cdc', 'cdc.id', 'md.controlled_by_cdc_id')
                ->leftJoin('users as cdcr', 'cdcr.id', 'md.controlled_by_cdcr_id')
                ->leftJoin('users as dcp', 'dcp.id', 'md.controlled_by_dcp_id')
                ->leftJoin('users as mde', 'mde.id', 'md.controlled_by_ci_id');

            $details = $details->groupBy(
                'md.id',
                'md.major_fact',
                'controlled_by_ci_at',
                'cdc.last_name',
                'cdc.first_name',
                'cdcr.last_name',
                'cdcr.first_name',
                'dcp.last_name',
                'dcp.first_name',
                'mde.last_name',
                'mde.first_name',
                'md.controlled_by_ci_id'
            );

            $details = $details->get();
            foreach ($details as $detail) {
                DB::table('mission_details')->where('id', $detail->id)->update([
                    'cdc_full_name' => $detail->fk_cdc_validator_full_name,
                    'cdcr_full_name' => $detail->fk_cdcr_validator_full_name,
                    'dcp_full_name' => $detail->fk_dcp_validator_full_name,
                    'major_fact_is_detected_by_full_name' => $detail->major_fact ? $detail->fk_md_validator_full_name : NULL,
                    'major_fact_is_detected_by_id' => $detail->major_fact ? $detail->controlled_by_ci_id : NULL,
                    'major_fact_is_detected_at' => $detail->major_fact ? $detail->controlled_by_ci_at : NULL,
                ]);
            }
        });
    }
}