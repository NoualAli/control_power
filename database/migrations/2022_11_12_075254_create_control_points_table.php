<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_points', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('process_id');
            $table->json('scores')->nullable();
            $table->json('fields')->nullable();

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
        Schema::dropIfExists('control_points');
    }
}