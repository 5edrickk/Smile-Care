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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('prenom');

            $table->bigInteger('id_role')->unsigned();

            $table->string('photo')->nullable();
            $table->date('dateNaissance')->nullable();
            $table->string('addresse')->nullable();
            $table->bigInteger('telephone')->nullable();
            $table->bigInteger('codeEmploye')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('password_changed_at')->nullable();
            $table->bigInteger('num_assurance')->nullable();
            $table->string('note_clinique')->nullable();

            $table->bigInteger('ordonnance')->unsigned()->nullable();

            $table->rememberToken();
        });

        Schema::table('users', function(Blueprint $table) {
            $table->foreign('id_role')->references('id')->on('roles');
            $table->foreign('ordonnance')->references('id')->on('medicaments');
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');

        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
