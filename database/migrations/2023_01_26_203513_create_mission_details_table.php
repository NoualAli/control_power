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
            $table->timestamp('executed_at')->nullable();
            $table->timestamp('validated_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

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