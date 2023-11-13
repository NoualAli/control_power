<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 30)->unique();
            $table->string('first_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('email', 100)->unique();
            $table->string('phone', 14)->nullable();
            $table->string('avatar')->nullable();
            $table->tinyInteger('gender')->default(1);
            $table->string('password')->nullable();
            $table->string('active_post')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('registration_number')->nullable();
            $table->rememberToken();

            if (env('DB_CONNECTION') == 'mysql') {
                $table->timestamps();
            } else {
                $table->timestamps(7);
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
        Schema::dropIfExists('users');
    }
}
