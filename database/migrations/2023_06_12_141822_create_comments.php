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
        Schema::create('comments', function (Blueprint $table) {
            $table->uuid('id');
            $table->text('content');
            $table->string('type');
            $table->string('commentable_type');
            $table->string('commentable_id', 36)->nullable();
            $table->foreignId('created_by_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('comments');
    }
};
