<?php

/**
 * Šī migrācija pievieno administratora statusa lauku
 * users tabulai recepšu tīmekļa vietnes datubāzē.
 *
 * Migrācija atbild par:
 * - administratora statusa glabāšanas lauka izveidi;
 * - lietotāju tiesību līmeņu nodrošināšanu;
 * - noklusējuma lietotāja statusa definēšanu;
 * - kolonnas dzēšanu migrācijas atcelšanas gadījumā.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Veic izmaiņas users tabulā.
     */
    public function up(): void
    {
        /**
         * Tiek modificēta users tabula,
         * pievienojot administratora statusa lauku.
         */
        Schema::table('users', function (Blueprint $table) {

            /**
             * Boolean tipa lauks, kas nosaka,
             * vai lietotājam ir administratora tiesības.
             *
             * Noklusējuma vērtība ir false.
             */
            $table->boolean('is_admin')->default(false);
        });
    }

    /**
     * Atceļ veiktās izmaiņas users tabulā.
     */
    public function down(): void
    {
        /**
         * Tiek dzēsta is_admin kolonna no users tabulas.
         */
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');
        });
    }
};