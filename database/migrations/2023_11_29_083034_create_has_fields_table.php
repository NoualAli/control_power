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
        Schema::create('has_fields', function (Blueprint $table) {
            $table->string('attachable_type');
            $table->string('attachable_id', 36)->nullable();
            $table->unsignedBigInteger('field_id');

            if (env('DB_CONNECTION') == 'mysql') {
                $table->timestamps();
            } else {
                $table->timestamps(7);
            }

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
        Schema::dropIfExists('has_fields');
    }
};
