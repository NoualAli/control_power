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
        Schema::create('mission_detail_regularizations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('action_to_be_taken');
            $table->boolean('is_regularized')->default(false);
            $table->foreignId('created_by_id');
            $table->foreignUuid('mission_detail_id');
            if (env('DB_CONNECTION') == 'mysql') {
                $table->timestamp('created_at');
            } else {
                $table->timestamp('created_at', 7);
            }

            $table->foreign('mission_detail_id')->on('mission_details')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by_id')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mission_detail_regularizations');
    }
};
