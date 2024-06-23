<?php

namespace Database\Seeders;

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
            DB::table('missions')->where('current_state', 8)->update(['current_state' => 7]);

            Schema::dropColumns('missions', 'deleted_at');
            Schema::dropColumns('mission_details', 'deleted_at');
            Schema::dropColumns('control_campaigns', 'deleted_at');
        });
    }
}