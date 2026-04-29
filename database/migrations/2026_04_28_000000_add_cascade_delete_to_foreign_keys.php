<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('shifts', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });

        Schema::table('user_medicament', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });

        // Les paiements doivent être supprimés avant les rendez_vous
        Schema::table('paiements', function (Blueprint $table) {
            $table->dropForeign(['id_rendez_vous']);
            $table->foreign('id_rendez_vous')->references('id')->on('rendez_vous')->onDelete('cascade');
        });

        Schema::table('rendez_vous', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropForeign(['id_dentiste']);
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_dentiste')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('rendez_vous', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropForeign(['id_dentiste']);
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_dentiste')->references('id')->on('users');
        });

        Schema::table('paiements', function (Blueprint $table) {
            $table->dropForeign(['id_rendez_vous']);
            $table->foreign('id_rendez_vous')->references('id')->on('rendez_vous');
        });

        Schema::table('user_medicament', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->foreign('id_user')->references('id')->on('users');
        });

        Schema::table('shifts', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->foreign('id_user')->references('id')->on('users');
        });
    }
};
