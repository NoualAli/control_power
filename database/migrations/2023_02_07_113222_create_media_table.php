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
            $table->uuid('id')->primary();
            $table->string('original_name');
            $table->string('hash_name');
            $table->string('folder');
            $table->string('extension');
            $table->string('mimetype');
            $table->string('size');
            $table->json('payload')->nullable();
            $table->string('attachable_type');
            $table->string('attachable_id', 36)->nullable();
            $table->foreignId('uploaded_by_id')->nullable();

            if (env('DB_CONNECTION') == 'mysql') {
                $table->timestamps();
            } else {
                $table->timestamps(7);
            }

            $table->foreign('uploaded_by_id')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');
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
