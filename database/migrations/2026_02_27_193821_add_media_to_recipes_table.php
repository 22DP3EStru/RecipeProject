<?php

/**
 * Šī migrācija papildina recipes tabulu
 * ar multivides failu laukiem.
 *
 * Migrācija atbild par:
 * - receptes attēla ceļa glabāšanu;
 * - receptes video faila ceļa glabāšanu;
 * - receptes video saites glabāšanu;
 * - multivides funkcionalitātes nodrošināšanu;
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
         * ar attēlu un video laukiem.
         */
        Schema::table('recipes', function (Blueprint $table) {

            /**
             * Lauks receptes attēla faila ceļa glabāšanai.
             * Var saturēt NULL vērtību.
             */
            $table->string('image_path')->nullable();

            /**
             * Lauks receptes video faila ceļa glabāšanai.
             * Var saturēt NULL vērtību.
             */
            $table->string('video_path')->nullable();

            /**
             * Lauks receptes video saites glabāšanai.
             * Var saturēt NULL vērtību.
             */
            $table->string('video_url')->nullable();
        });
    }

    /**
     * Atceļ veiktās izmaiņas recipes tabulā.
     */
    public function down(): void
    {
        /**
         * Kolonnas tiek dzēstas tikai tad,
         * ja tās eksistē datubāzes tabulā.
         */

        if (Schema::hasColumn('recipes', 'video_url')) {
            Schema::table('recipes', function (Blueprint $table) {
                $table->dropColumn('video_url');
            });
        }

        if (Schema::hasColumn('recipes', 'video_path')) {
            Schema::table('recipes', function (Blueprint $table) {
                $table->dropColumn('video_path');
            });
        }

        if (Schema::hasColumn('recipes', 'image_path')) {
            Schema::table('recipes', function (Blueprint $table) {
                $table->dropColumn('image_path');
            });
        }
    }
};