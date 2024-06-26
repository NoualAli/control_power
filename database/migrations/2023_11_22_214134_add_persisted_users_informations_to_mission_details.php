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
            $table->string('cdc_full_name')->nullable();
            $table->string('cdcr_full_name')->nullable();
            $table->string('dcp_full_name')->nullable();
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
            $table->dropColumn('cdc_full_name');
            $table->dropColumn('cdcr_full_name');
            $table->dropColumn('dcp_full_name');
        });
    }
};