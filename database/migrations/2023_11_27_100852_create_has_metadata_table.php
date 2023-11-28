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
        Schema::create('has_metadata', function (Blueprint $table) {
            $table->string('matadatable_type');
            $table->string('matadatable_id', 36)->nullable();
            $table->string('key');
            $table->string('value');
            $table->unsignedBigInteger('field_id');

            $table->foreign('field_id')->on('fields')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('has_metadata');
    }
};
