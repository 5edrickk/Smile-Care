<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rendez_vous', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_dentiste')->unsigned();
            $table->bigInteger('id_etat')->unsigned();

            $table->timestamp('heure_date');
            $table->string('commentaire')->nullable();
        });
        Schema::table('rendez_vous', function(Blueprint $table) {
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_dentiste')->references('id')->on('users');
            $table->foreign('id_etat')->references('id')->on('etats_rendez_vous');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rendez_vous');
    }
};
