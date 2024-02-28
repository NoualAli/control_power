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
            DB::table('missions')->where('current_state', 7)->update(['current_state' => 8]);
        });
    }
}
