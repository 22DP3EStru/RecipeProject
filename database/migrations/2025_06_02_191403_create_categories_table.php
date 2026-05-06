<?php

/**
 * Šī migrācija izveido categories tabulu
 * recepšu tīmekļa vietnes datubāzē.
 *
 * Migrācija atbild par:
 * - recepšu kategoriju glabāšanas struktūras izveidi;
 * - kategoriju nosaukumu saglabāšanu;
 * - automātisko laika zīmogu izveidi;
 * - tabulas dzēšanu migrācijas atcelšanas gadījumā.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Izveido categories tabulu.
     */
    public function up(): void
    {
        /**
         * Tiek izveidota categories tabula,
         * kurā tiek glabātas recepšu kategorijas.
         */
        Schema::create('categories', function (Blueprint $table) {

            /**
             * Primārā atslēga ar automātisku ID pieaugumu.
             */
            $table->id();

            /**
             * Kategorijas nosaukums.
             */
            $table->string('name');

            /**
             * Automātiski izveido created_at un updated_at laukus.
             */
            $table->timestamps();
        });
    }

    /**
     * Atceļ migrāciju un dzēš categories tabulu.
     */
    public function down(): void
    {
        /**
         * Tiek dzēsta categories tabula.
         */
        Schema::dropIfExists('categories');
    }
};