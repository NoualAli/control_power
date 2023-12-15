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
        Schema::create('user_has_notifications', function (Blueprint $table) {
            $table->boolean('database_is_enabled')->default(true);
            $table->boolean('email_is_enabled')->default(true);
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('notification_type_id')->constrained('notification_types')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('user_has_notifications');
    }
};
