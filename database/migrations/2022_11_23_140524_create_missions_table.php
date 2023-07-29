<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateMissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('reference')->unique();
            $table->text('note')->nullable();

            // Relationships
            $table->foreignId('control_campaign_id');
            $table->foreignId('agency_id');
            $table->foreignId('created_by_id');
            $table->foreignId('cdcr_validation_by_id')->nullable()->constrained('users');
            $table->foreignId('dcp_validation_by_id')->nullable()->constrained('users');
            $table->foreignId('cdc_validation_by_id')->nullable()->constrained('users');
            $table->foreignId('ci_validation_by_id')->nullable()->constrained('users');
            $table->foreignId('cc_validation_by_id')->nullable()->constrained('users');

            if (env('DB_CONNECTION') == 'mysql') {
                $table->timestamp('programmed_start');
                $table->timestamp('programmed_end');
                $table->timestamp('reel_start')->nullable();
                $table->timestamp('reel_end')->nullable();
                $table->timestamp('cdc_validation_at')->nullable();
                $table->timestamp('ci_validation_at')->nullable();
                $table->timestamp('cc_validation_at')->nullable();
                $table->timestamp('cdcr_validation_at')->nullable();
                $table->timestamp('dcp_validation_at')->nullable();
                $table->timestamps();
                $table->softDeletes('deleted_at');
            } else {
                // Dates
                $table->timestamp('programmed_start', 7);
                $table->timestamp('programmed_end', 7);
                $table->timestamp('reel_start', 7)->nullable();
                $table->timestamp('reel_end', 7)->nullable();
                $table->timestamp('cdc_validation_at', 7)->nullable();
                $table->timestamp('ci_validation_at', 7)->nullable();
                $table->timestamp('cc_validation_at', 7)->nullable();
                $table->timestamp('cdcr_validation_at', 7)->nullable();
                $table->timestamp('dcp_validation_at', 7)->nullable();
                $table->timestamps(7);
                $table->softDeletes('deleted_at', 7);
            }

            $table->foreign('control_campaign_id')->on('control_campaigns')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('agency_id')->on('agencies')->references('id')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('missions');
    }
}
