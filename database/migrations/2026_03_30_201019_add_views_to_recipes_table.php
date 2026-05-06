<?php

/**
 * Šī migrācija papildina recipes tabulu
 * ar recepšu skatījumu skaita lauku.
 *
 * Migrācija atbild par:
 * - recepšu skatījumu statistikas glabāšanu;
 * - views kolonnas pievienošanu recipes tabulai;
 * - noklusējuma skatījumu vērtības definēšanu;
 * - kolonnu dzēšanu migrācijas atcelšanas gadījumā.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Veic izmaiņas recipes tabulā.
     */
    public function up(): void
    {
        /**
         * Tiek papildināta recipes tabula
         * ar skatījumu skaita lauku.
         */
        Schema::table('recipes', function (Blueprint $table) {

            /**
             * Lauks receptes skatījumu skaita glabāšanai.
             *
             * Noklusējuma vērtība ir 0.
             * Kolonna tiek pievienota aiz description lauka.
             */
            $table->unsignedInteger('views')
                ->default(0)
                ->after('description');
        });
    }

    /**
     * Atceļ veiktās izmaiņas recipes tabulā.
     */
    public function down(): void
    {
        /**
         * Tiek dzēsta views kolonna.
         */
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn('views');
        });
    }
};