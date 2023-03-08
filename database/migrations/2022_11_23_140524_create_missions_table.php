<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('reference')->unique();
            $table->string('note')->nullable();
            // $table->foreignUuid('state_id');

            // Relationships
            $table->foreignId('control_campaign_id');
            $table->foreignId('agency_id');
            $table->foreignId('created_by_id');
            $table->foreignId('cdcr_validation_by_id')->nullable();
            $table->foreignId('dcp_validation_by_id')->nullable();

            // Dates
            $table->timestamp('start');
            $table->timestamp('end');
            $table->timestamp('cdcr_validation_at')->nullable();
            $table->timestamp('dcp_validation_at')->nullable();
            $table->timestamps();
            $table->softDeletes();


            // $table->foreign('state_id')->on('mission_states')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('control_campaign_id')->on('control_campaigns')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('agency_id')->on('agencies')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by_id')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('cdcr_validation_by_id')->on('users')->references('id')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('dcp_validation_by_id')->on('users')->references('id')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('missions');
    }
}
