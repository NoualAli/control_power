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
        });
    }
}
