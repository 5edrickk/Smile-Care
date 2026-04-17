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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->decimal('montant', 5, 2);
            $table->bigInteger('id_rendez_vous')->unsigned();
            $table->bigInteger('id_etat')->unsigned();
            $table->bigInteger('id_type')->unsigned();
        });
        Schema::table('paiements', function(Blueprint $table) {
            $table->foreign('id_rendez_vous')->references('id')->on('rendez_vous');
            $table->foreign('id_etat')->references('id')->on('etats_paiements');
            $table->foreign('id_type')->references('id')->on('types_paiements');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
