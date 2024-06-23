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
        Schema::table('domains', function (Blueprint $table) {
            $table->tinyInteger('display_priority')->default(1);
            $table->boolean('is_active')->default(true);
            $table->boolean('usable_for_agency')->default(false);
            $table->boolean('usable_for_dre')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('domains', function (Blueprint $table) {
            $table->dropColumn('display_priority');
            $table->dropColumn('is_active');
            $table->dropColumn('usable_for_agency');
            $table->dropColumn('usable_for_dre');
        });
    }
};
