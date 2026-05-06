<?php

/**
 * Šī migrācija izveido recipe_reviews tabulu
 * recepšu tīmekļa vietnes datubāzē.
 *
 * Migrācija atbild par:
 * - recepšu vērtējumu glabāšanas struktūras izveidi;
 * - vērtējumu sasaisti ar lietotājiem;
 * - vērtējumu sasaisti ar receptēm;
 * - komentāru glabāšanu pie vērtējumiem;
 * - unikāla vērtējuma ierobežojuma nodrošināšanu;
 * - automātisko laika zīmogu izveidi;
 * - tabulas dzēšanu migrācijas atcelšanas gadījumā.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Izveido recipe_reviews tabulu.
     */
    public function up(): void
    {
        /**
         * Tiek izveidota recipe_reviews tabula,
         * kurā tiek glabāti lietotāju recepšu vērtējumi.
         */
        Schema::create('recipe_reviews', function (Blueprint $table) {

            /**
             * Primārā atslēga ar automātisku ID pieaugumu.
             */
            $table->id();

            /**
             * Ārējā atslēga uz recipes tabulu.
             *
             * Ja recepte tiek dzēsta,
             * tiek dzēsti arī ar to saistītie vērtējumi.
             */
            $table->foreignId('recipe_id')
                ->constrained()
                ->cascadeOnDelete();

            /**
             * Ārējā atslēga uz users tabulu.
             *
             * Ja lietotājs tiek dzēsts,
             * tiek dzēsti arī viņa vērtējumi.
             */
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            /**
             * Lietotāja piešķirtais vērtējums.
             *
             * Tiek izmantots unsignedTinyInteger tips,
             * kas piemērots nelielām veselām vērtībām.
             */
            $table->unsignedTinyInteger('rating');

            /**
             * Papildu komentārs pie vērtējuma.
             * Var saturēt NULL vērtību.
             */
            $table->text('comment')->nullable();

            /**
             * Automātiski izveido created_at un updated_at laukus.
             */
            $table->timestamps();

            /**
             * Nodrošina, ka viens lietotājs
             * vienai receptei var pievienot tikai vienu vērtējumu.
             */
            $table->unique(['recipe_id', 'user_id']);
        });
    }

    /**
     * Atceļ migrāciju un dzēš recipe_reviews tabulu.
     */
    public function down(): void
    {
        /**
         * Tiek dzēsta recipe_reviews tabula.
         */
        Schema::dropIfExists('recipe_reviews');
    }
};