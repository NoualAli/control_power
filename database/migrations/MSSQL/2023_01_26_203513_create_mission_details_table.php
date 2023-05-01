<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignId('control_point_id');
            $table->foreignUuid('mission_id');
            $table->text('report')->nullable();
            $table->text('recovery_plan')->nullable();
            $table->tinyInteger('score')->nullable();
            $table->boolean('major_fact')->default(false);
            $table->json('metadata')->nullable();

            $table->timestamp('executed_at', 7)->nullable();
            $table->timestamp('processed_at', 7)->nullable();
            $table->timestamp('validated_at', 7)->nullable();
            $table->timestamp('major_fact_dispatched_at', 7)->nullable();
            $table->timestamps(7);
            $table->softDeletes('deleted_at', 7);

            $table->foreign('control_point_id')->on('control_points')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('mission_id')->on('missions')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mission_details');
    }
}
