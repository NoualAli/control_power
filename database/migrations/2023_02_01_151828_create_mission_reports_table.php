<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMissionReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mission_reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->set('type', ['Avis contrôleur', 'Rapport', 'Synthèse', 'Commentaire']);
            $table->text('content');
            $table->foreignUuid('mission_id');
            $table->foreignId('created_by_id');
            $table->timestamp('validated_at')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('mission_id')->on('missions')->references('id')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('mission_reports');
    }
}
