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
        Schema::table('mission_details', function (Blueprint $table) {
            $table->foreignUuid('regularization_id')->constrained('regularizations');
            //$table->foreign('regularization_id')->on('regularizations')->references('id')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mission_details', function (Blueprint $table) {
            //
        });
    }
};
