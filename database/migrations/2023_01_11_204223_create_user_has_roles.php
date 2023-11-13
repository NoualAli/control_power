<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserHasRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_has_roles', function (Blueprint $table) {
            $table->foreignId('user_id');
            $table->foreignId('role_id');

            if (env('DB_CONNECTION') == 'mysql') {
                $table->timestamps();
            } else {
                $table->timestamps(7);
            }

            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('role_id')->on('roles')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_has_roles');
    }
}
