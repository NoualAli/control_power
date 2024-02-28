<?php

namespace Database\Seeders;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class MissionDetailRegularizationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        Schema::table('mission_detail_regularizations', function (Blueprint $table) {
            $table->dropColumn('rejection_comment');
        });
    }
}
