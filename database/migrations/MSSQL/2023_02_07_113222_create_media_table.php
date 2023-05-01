<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('original_name');
            $table->string('hash_name');
            $table->string('folder');
            $table->string('extension');
            $table->string('mimetype');
            $table->string('size');
            $table->string('attachable_type');
            $table->string('attachable_id', 36);
            $table->timestamps(7);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('media');
    }
}
