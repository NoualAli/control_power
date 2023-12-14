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
        Schema::table('control_campaigns', function (Blueprint $table) {
            $table->boolean('is_for_testing')->default(false);
        });

        Schema::table('missions', function (Blueprint $table) {
            $table->boolean('is_for_testing')->default(false);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_for_testing')->default(false);
        });

        Schema::table('dres', function (Blueprint $table) {
            $table->boolean('is_for_testing')->default(false);
        });

        Schema::table('agencies', function (Blueprint $table) {
            $table->boolean('is_for_testing')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('control_campaigns', function (Blueprint $table) {
            $table->removeColumn('is_for_testing');
        });

        Schema::table('missions', function (Blueprint $table) {
            $table->removeColumn('is_for_testing');
        });

        Schema::table('users', function (Blueprint $table) {
            $table->removeColumn('is_for_testing');
        });

        Schema::table('dres', function (Blueprint $table) {
            $table->removeColumn('is_for_testing');
        });

        Schema::table('agencies', function (Blueprint $table) {
            $table->removeColumn('is_for_testing');
        });
    }
};
