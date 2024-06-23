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
        Schema::create('category_has_processes', function (Blueprint $table) {
            $table->foreignId('category_id');
            $table->foreignId('process_id');

            $table->foreign('category_id')->on('categories')->references('id')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('category_has_processes');
    }
};
