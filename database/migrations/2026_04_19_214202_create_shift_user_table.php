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
        Schema::create('shift_user', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->bigInteger('id_shift')->unsigned();
            $table->bigInteger('id_user')->unsigned();
        });
        Schema::table('shift_user', function (Blueprint $table) {
            $table->foreign('id_shift')->references('id')->on('shifts');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shift_user');
    }
};
