<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlCampaignProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_campaign_processes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('control_campaign_id');
            $table->foreignId('process_id');
            // $table->boolean('sampling');

            $table->foreign('control_campaign_id')->on('control_campaigns')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('process_id')->on('processes')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('control_campaign_processes');
    }
}