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
            $table->string('major_fact_is_dispatched_by_full_name')->nullable();
            $table->string('major_fact_is_dispatched_to_dcp_by_full_name')->nullable();
            $table->string('major_fact_is_detected_by_full_name')->nullable();
            $table->string('major_fact_is_rejected_by_full_name')->nullable();

            $table->boolean('major_fact_is_rejected')->default(false);

            // Foreign keys
            $table->foreignId('major_fact_is_detected_by_id')->nullable()->constrained('users');
            $table->foreignId('major_fact_is_dispatched_to_dcp_by_id')->nullable()->constrained('users');
            $table->foreignId('major_fact_is_dispatched_by_id')->nullable()->constrained('users');
            $table->foreignId('major_fact_is_rejected_by_id')->nullable()->constrained('users');

            // timesamps
            $table->timestamp('major_fact_is_detected_at', 7)->nullable();
            $table->timestamp('major_fact_is_rejected_at', 7)->nullable();
            $table->timestamp('major_fact_is_dispatched_at', 7)->nullable();
            $table->timestamp('major_fact_is_dispatched_to_dcp_at', 7)->nullable();
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
            $table->dropConstrainedForeignId('major_fact_is_rejected_by_id');
            $table->dropConstrainedForeignId('major_fact_is_detected_by_id');
            $table->dropConstrainedForeignId('major_fact_is_dispatched_to_dcp_by_id');
            $table->dropConstrainedForeignId('major_fact_is_dispatched_by_id');

            $table->dropColumn('major_fact_is_detected_by_full_name');
            $table->dropColumn('major_fact_is_rejected');
            $table->dropColumn('major_fact_is_rejected_by_full_name');
            $table->dropColumn('major_fact_is_rejected_at');
        });
    }
};
