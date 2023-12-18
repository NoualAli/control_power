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


            $campaigns = DB::table('control_campaigns as c')->select([
                'c.id',
                DB::raw("CONCAT(creator.first_name, ' ', creator.last_name) AS fk_creator_full_name"),
                DB::raw("CONCAT(validator.first_name, ' ', validator.last_name) AS fk_validator_full_name"),
            ]);
            $campaigns = $campaigns
                ->join('users as creator', 'creator.id', 'c.created_by_id')
                ->join('users as validator', 'validator.id', 'c.validated_by_id');

            $campaigns = $campaigns->groupBy(
                'c.id',
                'creator.last_name',
                'creator.first_name',
                'validator.last_name',
                'validator.first_name',
            );
            $campaigns = $campaigns->get();
            foreach ($campaigns as $campaign) {
                DB::table('control_campaigns')->where('id', $campaign->id)->update([
                    'validator_full_name' => $campaign->fk_validator_full_name,
                    'creator_full_name' => $campaign->fk_creator_full_name,
                ]);
            }
        });
    }
}