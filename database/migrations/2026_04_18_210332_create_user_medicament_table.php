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
        Schema::create('user_medicament', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigInteger('id_user')->unsigned();
            $table->bigInteger('id_medicament')->unsigned();
            $table->primary(['id_user', 'id_medicament']);
        });
        Schema::table('user_medicament', function (Blueprint $table) {
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_medicament')->references('id')->on('medicaments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_medicament');
    }
};
