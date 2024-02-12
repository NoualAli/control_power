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
            $table->boolean('reg_is_rejected')->default(false);
            $table->boolean('reg_is_regularized')->default(false);
            $table->boolean('reg_is_sanitation_in_progress')->default(false);
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
            $table->dropColumn('reg_is_rejected');
            $table->dropColumn('reg_is_regularized');
            $table->dropColumn('reg_is_sanitation_in_progress');
        });
    }
};