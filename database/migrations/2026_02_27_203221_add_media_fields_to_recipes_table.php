<?php

/**
 * Šī migrācija papildina recipes tabulu
 * ar attēlu un video informācijas laukiem.
 *
 * Migrācija atbild par:
 * - receptes attēla faila ceļa glabāšanu;
 * - receptes attēla URL glabāšanu;
 * - receptes video faila ceļa glabāšanu;
 * - receptes video URL glabāšanu;
 * - multivides funkcionalitātes paplašināšanu;
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
             *
             * Kolonna tiek pievienota aiz description lauka.
             */
            $table->string('image_path')
                ->nullable()
                ->after('description');

            /**
             * Lauks receptes attēla URL adreses glabāšanai.
             *
             * Kolonna tiek pievienota aiz image_path lauka.
             */
            $table->string('image_url')
                ->nullable()
                ->after('image_path');

            /**
             * Lauks receptes video faila ceļa glabāšanai.
             *
             * Kolonna tiek pievienota aiz image_url lauka.
             */
            $table->string('video_path')
                ->nullable()
                ->after('image_url');

            /**
             * Lauks receptes video URL adreses glabāšanai.
             *
             * Kolonna tiek pievienota aiz video_path lauka.
             */
            $table->string('video_url')
                ->nullable()
                ->after('video_path');
        });
    }

    /**
     * Atceļ veiktās izmaiņas recipes tabulā.
     */
    public function down(): void
    {
        /**
         * Tiek dzēstas visas pievienotās multivides kolonnas.
         */
        Schema::table('recipes', function (Blueprint $table) {

            $table->dropColumn([
                'image_path',
                'image_url',
                'video_path',
                'video_url'
            ]);
        });
    }
};