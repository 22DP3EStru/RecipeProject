<?php

/**
 * Šī migrācija izveido recipe_ingredients tabulu
 * recepšu tīmekļa vietnes datubāzē.
 *
 * Migrācija atbild par:
 * - recepšu sastāvdaļu glabāšanas struktūras izveidi;
 * - sastāvdaļu sasaisti ar receptēm;
 * - sastāvdaļu daudzuma glabāšanu;
 * - mērvienību glabāšanu;
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
     * Izveido recipe_ingredients tabulu.
     */
    public function up(): void
    {
        /**
         * Tiek izveidota recipe_ingredients tabula,
         * kurā tiek glabātas recepšu sastāvdaļas.
         */
        Schema::create('recipe_ingredients', function (Blueprint $table) {

            /**
             * Primārā atslēga ar automātisku ID pieaugumu.
             */
            $table->id();

            /**
             * Ārējā atslēga uz recipes tabulu.
             *
             * Ja recepte tiek dzēsta,
             * tiek dzēstas arī ar to saistītās sastāvdaļas.
             */
            $table->foreignId('recipe_id')
                ->constrained('recipes')
                ->onDelete('cascade');

            /**
             * Sastāvdaļas nosaukums.
             *
             * Piemēram:
             * - Milti
             * - Cukurs
             * - Piens
             */
            $table->string('name');

            /**
             * Sastāvdaļas daudzums.
             *
             * Piemēram:
             * - 200.00
             * - 1.50
             *
             * Var saturēt NULL vērtību.
             */
            $table->decimal('quantity', 10, 2)->nullable();

            /**
             * Sastāvdaļas mērvienība.
             *
             * Piemēram:
             * - g
             * - ml
             * - gab
             *
             * Var saturēt NULL vērtību.
             */
            $table->string('unit', 30)->nullable();

            /**
             * Automātiski izveido created_at un updated_at laukus.
             */
            $table->timestamps();
        });
    }

    /**
     * Atceļ migrāciju un dzēš recipe_ingredients tabulu.
     */
    public function down(): void
    {
        /**
         * Tiek dzēsta recipe_ingredients tabula.
         */
        Schema::dropIfExists('recipe_ingredients');
    }
};