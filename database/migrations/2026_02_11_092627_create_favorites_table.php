<?php

/**
 * Šī migrācija izveido favorites tabulu
 * recepšu tīmekļa vietnes datubāzē.
 *
 * Migrācija atbild par:
 * - favorītu sistēmas datu glabāšanas struktūras izveidi;
 * - lietotāju sasaisti ar favorītu receptēm;
 * - pivot tabulas izveidi daudzi-preti-daudzi relācijai;
 * - unikālu favorītu ierobežojuma nodrošināšanu;
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
     * Izveido favorites tabulu.
     */
    public function up(): void
    {
        /**
         * Tiek izveidota favorites pivot tabula,
         * kas glabā lietotāju favorītu receptes.
         */
        Schema::create('favorites', function (Blueprint $table) {

            /**
             * Primārā atslēga ar automātisku ID pieaugumu.
             */
            $table->id();

            /**
             * Ārējā atslēga uz users tabulu.
             *
             * Ja lietotājs tiek dzēsts,
             * tiek dzēsti arī viņa favorītu ieraksti.
             */
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            /**
             * Ārējā atslēga uz recipes tabulu.
             *
             * Ja recepte tiek dzēsta,
             * tiek dzēsti arī tās favorītu ieraksti.
             */
            $table->foreignId('recipe_id')
                ->constrained()
                ->cascadeOnDelete();

            /**
             * Automātiski izveido created_at un updated_at laukus.
             */
            $table->timestamps();

            /**
             * Nodrošina, ka viens lietotājs
             * nevar vienu un to pašu recepti pievienot favorītiem vairākas reizes.
             */
            $table->unique(['user_id', 'recipe_id']);
        });
    }

    /**
     * Atceļ migrāciju un dzēš favorites tabulu.
     */
    public function down(): void
    {
        /**
         * Tiek dzēsta favorites tabula.
         */
        Schema::dropIfExists('favorites');
    }
};