<?php

/**
 * Šī migrācija papildina users tabulu
 * ar profila attēla glabāšanas lauku.
 *
 * Migrācija atbild par:
 * - lietotāja profila attēla ceļa glabāšanu;
 * - profile_photo kolonnas pievienošanu users tabulai;
 * - profila attēlu funkcionalitātes nodrošināšanu;
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
         * Tiek papildināta users tabula
         * ar profila attēla lauku.
         */
        Schema::table('users', function (Blueprint $table) {

            /**
             * Lauks lietotāja profila attēla faila ceļa glabāšanai.
             *
             * Var saturēt NULL vērtību.
             * Kolonna tiek pievienota aiz email lauka.
             */
            $table->string('profile_photo')
                ->nullable()
                ->after('email');
        });
    }

    /**
     * Atceļ veiktās izmaiņas users tabulā.
     */
    public function down(): void
    {
        /**
         * Tiek dzēsta profile_photo kolonna.
         */
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_photo');
        });
    }
};