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
            $table->text('ci_report')->nullable();
            $table->text('cdc_report')->nullable();
            $table->text('recovery_plan')->nullable();
            $table->tinyInteger('score')->nullable();
            $table->boolean('major_fact')->default(false);
            $table->json('metadata')->nullable();

            $table->foreignId('assigned_to_ci_id')->nullable()->constrained('users');
            $table->foreignId('assigned_to_cc_id')->nullable()->constrained('users');
            $table->foreignId('controlled_by_ci_id')->nullable()->constrained('users');
            $table->foreignId('controlled_by_cc_id')->nullable()->constrained('users');

            if (env('DB_CONNECTION') == 'mysql') {
                $table->timestamp('controlled_at')->nullable();
                $table->timestamp('major_fact_dispatched_at')->nullable();
                $table->timestamps();
                $table->softDeletes();
            } else {
                $table->timestamp('controlled_at', 7)->nullable();
                $table->timestamp('major_fact_dispatched_at', 7)->nullable();
                $table->timestamps(7);
                $table->softDeletes('deleted_at', 7);
            }

            $table->foreign('control_point_id')->on('control_points')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('mission_id')->on('missions')->references('id')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('assigned_to_ci_id')->on('users')->references('id')->onDelete('SET NULL')->onUpdate('SET NULL');
            // $table->foreign('assigned_to_cc_id')->on('users')->references('id')->onDelete('SET NULL')->onUpdate('SET NULL');
            // $table->foreign('controlled_by_ci_id')->on('users')->references('id')->onDelete('SET NULL')->onUpdate('SET NULL');
            // $table->foreign('controlled_by_cc_id')->on('users')->references('id')->onDelete('SET NULL')->onUpdate('SET NULL');
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
