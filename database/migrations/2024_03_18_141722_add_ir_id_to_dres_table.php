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
        Schema::table('dres', function (Blueprint $table) {
            $table->foreignId('ir_id')->nullable();
            $table->foreign('ir_id')->on('regional_inspections')->references('id')->onDelete('SET NULL')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dres', function (Blueprint $table) {
            //
        });
    }
};
