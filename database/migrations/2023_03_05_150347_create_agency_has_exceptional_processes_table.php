<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agency_has_exceptional_processes', function (Blueprint $table) {
            $table->foreignId('agency_id');
            $table->foreignId('process_id');
            $table->boolean('is_usable');

            $table->foreign('agency_id')->on('agencies')->references('id')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('agency_has_exceptional_processes');
    }
};
