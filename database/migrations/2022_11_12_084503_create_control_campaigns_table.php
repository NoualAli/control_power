<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateControlCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('control_campaigns', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('reference');
            // $table->string('state', 30)->default('À effectuer');
            // $table->set('state', ['En cours', 'Réaliser', 'En retard', 'À effectuer'])->default('À effectuer');
            $table->foreignId('created_by_id')->constrained('users');
            $table->foreignId('validated_by_id')->constrained('users');

            if (env('DB_CONNECTION') == 'mysql') {
                $table->timestamp('validated_at')->nullable();
                $table->timestamp('start_date');
                $table->timestamp('end_date');
                $table->timestamps();
                $table->softDeletes('deleted_at');
            } else {
                $table->timestamp('validated_at', 7)->nullable();
                $table->timestamp('start_date', 7);
                $table->timestamp('end_date', 7);
                $table->timestamps(7);
                $table->softDeletes('deleted_at', 7);
            }
            //$table->foreign('created_by_id')->on('users')->references('id')->onDelete('set null')->onUpdate('set null');
            //$table->foreign('validated_by_id')->on('users')->references('id')->onDelete('set null')->onUpdate('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('control_compaigns');
    }
}
