<?php

/**
 * Šī migrācija izveido galvenās autentifikācijas un sesiju tabulas
 * recepšu tīmekļa vietnes datubāzē.
 *
 * Migrācija atbild par:
 * - lietotāju tabulas izveidi;
 * - paroles atiestatīšanas tokenu tabulas izveidi;
 * - sesiju glabāšanas tabulas izveidi;
 * - autentifikācijas datu struktūras sagatavošanu;
 * - tabulu dzēšanu migrācijas atcelšanas gadījumā.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Izveido datubāzes tabulas.
     */
    public function up(): void
    {
        /**
         * Tiek izveidota users tabula,
         * kurā tiek glabāti sistēmas lietotāju dati.
         */
        Schema::create('users', function (Blueprint $table) {

            /**
             * Primārā atslēga ar automātisku ID pieaugumu.
             */
            $table->id();

            /**
             * Lietotāja vārds.
             */
            $table->string('name');

            /**
             * Lietotāja e-pasta adrese.
             * Lauks ir unikāls.
             */
            $table->string('email')->unique();

            /**
             * E-pasta apstiprināšanas datums un laiks.
             * Var saturēt NULL vērtību.
             */
            $table->timestamp('email_verified_at')->nullable();

            /**
             * Lietotāja parole.
             */
            $table->string('password');

            /**
             * Tokens funkcijai “remember me”.
             */
            $table->rememberToken();

            /**
             * Automātiski izveido created_at un updated_at laukus.
             */
            $table->timestamps();
        });

        /**
         * Tiek izveidota password_reset_tokens tabula,
         * kas paredzēta paroles atiestatīšanas funkcionalitātei.
         */
        Schema::create('password_reset_tokens', function (Blueprint $table) {

            /**
             * E-pasta adrese tiek izmantota kā primārā atslēga.
             */
            $table->string('email')->primary();

            /**
             * Paroles atiestatīšanas tokens.
             */
            $table->string('token');

            /**
             * Tokena izveidošanas datums un laiks.
             * Var saturēt NULL vērtību.
             */
            $table->timestamp('created_at')->nullable();
        });

        /**
         * Tiek izveidota sessions tabula,
         * kas glabā lietotāju sesiju informāciju.
         */
        Schema::create('sessions', function (Blueprint $table) {

            /**
             * Sesijas identifikators kā primārā atslēga.
             */
            $table->string('id')->primary();

            /**
             * Ārējā atslēga uz users tabulu.
             * Var saturēt NULL vērtību.
             */
            $table->foreignId('user_id')->nullable()->index();

            /**
             * Lietotāja IP adrese.
             * Atbalsta arī IPv6 adreses.
             */
            $table->string('ip_address', 45)->nullable();

            /**
             * Informācija par lietotāja pārlūku.
             */
            $table->text('user_agent')->nullable();

            /**
             * Sesijas dati serializētā formā.
             */
            $table->longText('payload');

            /**
             * Pēdējās aktivitātes laiks.
             */
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Atceļ migrāciju un dzēš izveidotās tabulas.
     */
    public function down(): void
    {
        /**
         * Tiek dzēsta users tabula.
         */
        Schema::dropIfExists('users');

        /**
         * Tiek dzēsta password_reset_tokens tabula.
         */
        Schema::dropIfExists('password_reset_tokens');

        /**
         * Tiek dzēsta sessions tabula.
         */
        Schema::dropIfExists('sessions');
    }
};