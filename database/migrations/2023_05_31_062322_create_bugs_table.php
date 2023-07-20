*<?php

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
            Schema::create('bugs', function (Blueprint $table) {
                $table->uuid('id');
                $table->string('reference', 7)->unique();
                $table->tinyInteger('type');
                $table->tinyInteger('priority');
                $table->text('description');
                $table->foreignId('created_by_id');
                if (env('DB_CONNECTION') == 'mysql') {
                    $table->timestamp('fixed_at')->nullable();
                    $table->timestamps();
                } else {
                    $table->timestamp('fixed_at', 7)->nullable();
                    $table->timestamps(7);
                }

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
            Schema::dropIfExists('bugs');
        }
    };
