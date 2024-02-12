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
        Schema::table('mission_detail_regularizations', function (Blueprint $table) {
            $table->boolean('is_rejected')->default(false);
            $table->text('rejection_comment')->nullable();
            $table->string('rejector_full_name')->nullable();
            $table->foreignId('rejected_by_id')->nullable()->constrained('users');
            $table->timestamp('rejected_at', 7)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mission_detail_regularizations', function (Blueprint $table) {
            $table->dropColumn('is_rejected');
            $table->dropColumn('rejection_comment');
            $table->dropColumn('rejector_by_full_name');
            $table->dropColumn('rejected_by_id');
            $table->dropColumn('rejected_at');
        });
    }
};