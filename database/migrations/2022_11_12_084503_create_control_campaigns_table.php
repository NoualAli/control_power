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
            $table->string('description');
            $table->timestamp('start');
            $table->timestamp('end');
            $table->foreignId('created_by_id');
            $table->string('reference');
            $table->set('state', ['En cours', 'Réaliser', 'En retard', 'À effectuer'])->default('À effectuer');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by_id')->on('users')->references('id');
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