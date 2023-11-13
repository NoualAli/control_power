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
            $table->foreignId('da_validation_by_id')->nullable()->constrained('users');

            if (env('DB_CONNECTION') == 'mysql') {
                $table->timestamp('da_validation_at')->nullable();
            } else {
                $table->timestamp('da_validation_at', 7)->nullable();
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
        Schema::table('missions', function (Blueprint $table) {
            //
        });
    }
};
