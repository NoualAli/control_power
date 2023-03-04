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
            $table->timestamp('start');
            $table->timestamp('end');
            $table->foreignId('created_by_id')->nullable();
            $table->string('reference');
            $table->set('state', ['En cours', 'Réaliser', 'En retard', 'À effectuer'])->default('À effectuer');
            $table->foreignId('validated_by_id')->nullable();

            $table->timestamp('validated_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('created_by_id')->on('users')->references('id')->onDelete('set null')->onUpdate('set null');
            $table->foreign('validated_by_id')->on('users')->references('id')->onDelete('set null')->onUpdate('set null');
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
