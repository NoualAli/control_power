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
        Schema::create('event_logs', function (Blueprint $table) {
            $table->uuid();
            $table->string('type');
            $table->foreignId('user_id')->nullable();
            $table->string('user_full_name')->nullable();
            $table->string('attachable_id')->nullable();
            $table->string('attachable_type')->nullable();
            $table->json('payload')->nullable();
            $table->timestamp('created_at', 7)->useCurrent();

            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('event_logs');
    }
};
