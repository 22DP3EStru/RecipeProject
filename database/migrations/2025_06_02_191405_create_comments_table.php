<?php

/**
 * Šī migrācija izveido comments tabulu
 * recepšu tīmekļa vietnes datubāzē.
 *
 * Migrācija atbild par:
 * - komentāru datu glabāšanas struktūras izveidi;
 * - komentāru sasaisti ar lietotājiem;
 * - komentāru sasaisti ar receptēm;
 * - automātisko laika zīmogu izveidi;
 * - datu dzēšanas kaskādes nodrošināšanu;
 * - tabulas dzēšanu migrācijas atcelšanas gadījumā.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Izveido comments tabulu.
     */
    public function up(): void
    {
        /**
         * Tiek izveidota comments tabula,
         * kurā tiek glabāti lietotāju komentāri.
         */
        Schema::create('comments', function (Blueprint $table) {

            /**
             * Primārā atslēga ar automātisku ID pieaugumu.
             */
            $table->id();

            /**
             * Komentāra teksts.
             */
            $table->text('body');

            /**
             * Ārējā atslēga uz users tabulu.
             *
             * Ja lietotājs tiek dzēsts,
             * tiek dzēsti arī viņa komentāri.
             */
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            /**
             * Ārējā atslēga uz recipes tabulu.
             *
             * Ja recepte tiek dzēsta,
             * tiek dzēsti arī tās komentāri.
             */
            $table->foreignId('recipe_id')
                ->constrained()
                ->onDelete('cascade');

            /**
             * Automātiski izveido created_at un updated_at laukus.
             */
            $table->timestamps();
        });
    }

    /**
     * Atceļ migrāciju un dzēš comments tabulu.
     */
    public function down(): void
    {
        /**
         * Tiek dzēsta comments tabula.
         */
        Schema::dropIfExists('comments');
    }
};