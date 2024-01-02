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
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->string('type', 20);
            $table->string('label', 70)->unique();
            $table->string('name', 50)->unique();
            $table->string('placeholder', 100)->nullable();
            $table->string('help_text', 255)->nullable();
            $table->integer('columns');
            $table->string('options')->nullable();
            $table->unsignedInteger('min_length')->default(0);
            $table->unsignedInteger('max_length')->nullable();
            $table->boolean('required')->default(false);
            $table->boolean('distinct')->default(false);
            $table->boolean('is_integer_or_float')->default(false);
            $table->boolean('is_multiple')->default(false);
            $table->string('additional_rules')->nullable();
            if (env('DB_CONNECTION') == 'mysql') {
                $table->timestamps();
                $table->softDeletes();
            } else {
                $table->timestamps(7);
                $table->softDeletes('deleted_at', 7);
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
        Schema::dropIfExists('fields');
    }
};
