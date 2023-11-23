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
        Schema::table('missions', function (Blueprint $table) {
            $table->string('creator_full_name')->nullable();
            $table->string('cdc_validator_full_name')->nullable();
            $table->string('cdcr_validator_full_name')->nullable();
            $table->string('dcp_validator_full_name')->nullable();
            $table->string('da_validator_full_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mission', function (Blueprint $table) {
            //
        });
    }
};