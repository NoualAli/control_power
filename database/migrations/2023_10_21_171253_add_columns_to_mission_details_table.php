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
            if (env('DB_CONNECTION') == 'sqlsrv') {
                $table->timestamp('major_fact_is_detected_at', 7)->nullable();
                $table->timestamp('major_fact_is_dispatched_to_dcp_at', 7)->nullable();
            } else {
                $table->timestamp('major_fact_is_detected_at')->nullable();
                $table->timestamp('major_fact_is_dispatched_to_dcp_at')->nullable();
            }
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
            $table->removeColumn('major_fact_is_detected_at');
            $table->removeColumn('major_fact_is_dispatched_to_dcp_at');
        });
    }
};
