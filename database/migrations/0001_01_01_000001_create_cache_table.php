<?php

/**
 * Šī migrācija izveido kešatmiņas un kešatmiņas bloķēšanas tabulas
 * recepšu tīmekļa vietnes datubāzē.
 *
 * Migrācija atbild par:
 * - cache tabulas izveidi;
 * - cache_locks tabulas izveidi;
 * - kešatmiņas datu glabāšanas struktūras sagatavošanu;
 * - bloķēšanas mehānisma nodrošināšanu kešatmiņas darbībām;
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
         * Tiek izveidota cache tabula,
         * kurā tiek glabāti sistēmas kešatmiņas dati.
         */
        Schema::create('cache', function (Blueprint $table) {

            /**
             * Kešatmiņas ieraksta atslēga,
             * kas tiek izmantota kā primārā atslēga.
             */
            $table->string('key')->primary();

            /**
             * Kešatmiņā saglabātie dati.
             */
            $table->mediumText('value');

            /**
             * Kešatmiņas ieraksta derīguma termiņš.
             */
            $table->integer('expiration');
        });

        /**
         * Tiek izveidota cache_locks tabula,
         * kas nodrošina kešatmiņas bloķēšanas mehānismu.
         */
        Schema::create('cache_locks', function (Blueprint $table) {

            /**
             * Bloķējuma atslēga,
             * kas tiek izmantota kā primārā atslēga.
             */
            $table->string('key')->primary();

            /**
             * Bloķējuma īpašnieka identifikators.
             */
            $table->string('owner');

            /**
             * Bloķējuma derīguma termiņš.
             */
            $table->integer('expiration');
        });
    }

    /**
     * Atceļ migrāciju un dzēš izveidotās tabulas.
     */
    public function down(): void
    {
        /**
         * Tiek dzēsta cache tabula.
         */
        Schema::dropIfExists('cache');

        /**
         * Tiek dzēsta cache_locks tabula.
         */
        Schema::dropIfExists('cache_locks');
    }
};