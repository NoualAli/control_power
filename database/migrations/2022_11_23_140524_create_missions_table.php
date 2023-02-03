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

            // $table->timestamp('validated_at')->nullable();

            // Reports
            // $table->text('report')->nullable();
            // $table->text('validator_report')->nullable();
            $table->string('note')->nullable();

            // Relationships
            $table->foreignId('control_campaign_id');
            $table->foreignId('agency_id');
            $table->foreignId('created_by_id');
            // $table->foreignId('controlled_by_id')->nullable();

            // Dates
            $table->timestamp('start');
            $table->timestamp('end');
            $table->timestamps();
            $table->softDeletes();


            // $table->foreignId('validated_by_id')->nullable();
            // $table->foreignId('controller_id');

            $table->foreign('control_campaign_id')->on('control_campaigns')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('agency_id')->on('agencies')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by_id')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('validated_by_id')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('controlled_by_id')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');

            // $table->foreign('controller_id')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');
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