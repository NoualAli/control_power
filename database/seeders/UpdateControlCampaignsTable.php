<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateControlCampaignsTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {

            $tableName = 'control_campaigns';

            $uuid = \Illuminate\Support\Str::uuid();

            Schema::table('control_campaign_processes', function (Blueprint $table) {
                $table->dropForeign('control_campaign_processes_control_campaign_id_foreign');
                $table->dropColumn('control_campaign_id');
            });

            Schema::table('missions', function (Blueprint $table) {
                $table->dropForeign('missions_control_campaign_id_foreign');
                $table->dropColumn('control_campaign_id');
            });

            Schema::table($tableName, function (Blueprint $table) {
                $table->dropPrimary('PK__control___3213E83FF873BB97');
                $table->dropColumn('id');
            });

            Schema::table($tableName, function (Blueprint $table) {
                $table->uuid('id')->nullable();
            });
            $result = DB::statement("UPDATE $tableName SET id = '$uuid'");
            Schema::table($tableName, function (Blueprint $table) {
                $table->uuid('id')->primary()->nullable(false)->change();
            });


            Schema::table('missions', function (Blueprint $table) {
                $table->foreignUuid('control_campaign_id')->nullable();
                $table->foreign('control_campaign_id')->on('control_campaigns')->references('id')->onDelete('CASCADE');
            });
            $result = DB::statement("UPDATE missions SET control_campaign_id = '$uuid'");

            Schema::table('control_campaign_processes', function (Blueprint $table) {
                $table->foreignUuid('control_campaign_id')->nullable();
                $table->foreign('control_campaign_id')->on('control_campaigns')->references('id')->onDelete('CASCADE');
            });
            $result = DB::statement("UPDATE control_campaign_processes SET control_campaign_id = '$uuid'");
        });
    }
}
