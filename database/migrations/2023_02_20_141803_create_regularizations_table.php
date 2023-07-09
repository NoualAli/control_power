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
        Schema::create('regularizations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('reason')->nullable();
            $table->text('committed_action')->nullable();
            $table->text('action_to_be_taken')->nullable();
            $table->foreignId('regularized_by_id')->nullable();
            $table->timestamp('regularized_at', 7)->nullable();
            $table->timestamps(7);
            $table->foreign('regularized_by_id')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regularizations');
    }
};