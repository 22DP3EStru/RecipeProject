<?php

/**
 * Šī migrācija papildina comments tabulu
 * ar komentāru atbilžu funkcionalitāti.
 *
 * Migrācija atbild par:
 * - parent_id kolonnas pievienošanu;
 * - komentāru hierarhijas nodrošināšanu;
 * - atbilžu sistēmas izveidi komentāriem;
 * - pašreferencējošas relācijas izveidi;
 * - datu dzēšanas kaskādes nodrošināšanu;
 * - kolonnas dzēšanu migrācijas atcelšanas gadījumā.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Veic izmaiņas comments tabulā.
     */
    public function up(): void
    {
        /**
         * Tiek papildināta comments tabula
         * ar parent_id lauku.
         */
        Schema::table('comments', function (Blueprint $table) {

            /**
             * Ārējā atslēga uz comments tabulu.
             *
             * Šis lauks ļauj izveidot komentāru atbildes,
             * sasaistot komentāru ar citu komentāru.
             *
             * Ja vecākkomentārs tiek dzēsts,
             * tiek dzēstas arī visas tā atbildes.
             */
            $table->foreignId('parent_id')
                ->nullable()
                ->after('recipe_id')
                ->constrained('comments')
                ->cascadeOnDelete();
        });
    }

    /**
     * Atceļ veiktās izmaiņas comments tabulā.
     */
    public function down(): void
    {
        /**
         * Tiek dzēsta parent_id ārējā atslēga un kolonna.
         */
        Schema::table('comments', function (Blueprint $table) {
            $table->dropConstrainedForeignId('parent_id');
        });
    }
};