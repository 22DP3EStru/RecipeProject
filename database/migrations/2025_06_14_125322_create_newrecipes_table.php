<?php

/**
 * Šī migrācija izveido newrecipes tabulu
 * recepšu tīmekļa vietnes datubāzē.
 *
 * Migrācija atbild par:
 * - recepšu datu glabāšanas struktūras izveidi;
 * - receptes pamatinformācijas saglabāšanu;
 * - receptes sasaisti ar lietotāju;
 * - pagatavošanas parametru glabāšanu;
 * - kategorijas un sarežģītības informācijas glabāšanu;
 * - automātisko laika zīmogu izveidi;
 * - tabulas dzēšanu migrācijas atcelšanas gadījumā.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Izveido newrecipes tabulu.
     */
    public function up(): void
    {
        /**
         * Tiek izveidota newrecipes tabula,
         * kurā tiek glabātas receptes.
         */
        Schema::create('newrecipes', function (Blueprint $table) {

            /**
             * Primārā atslēga ar automātisku ID pieaugumu.
             */
            $table->id();

            /**
             * Receptes nosaukums.
             */
            $table->string('title');

            /**
             * Receptes apraksts.
             */
            $table->text('description');

            /**
             * Receptes sastāvdaļu saraksts.
             */
            $table->text('ingredients');

            /**
             * Receptes pagatavošanas instrukcijas.
             */
            $table->text('instructions');

            /**
             * Receptes kategorija.
             */
            $table->string('category');

            /**
             * Sagatavošanas laiks minūtēs.
             * Var saturēt NULL vērtību.
             */
            $table->integer('prep_time')->nullable();

            /**
             * Gatavošanas laiks minūtēs.
             * Var saturēt NULL vērtību.
             */
            $table->integer('cook_time')->nullable();

            /**
             * Porciju skaits.
             * Var saturēt NULL vērtību.
             */
            $table->integer('servings')->nullable();

            /**
             * Receptes sarežģītības līmenis.
             *
             * Atļautās vērtības:
             * - Easy
             * - Medium
             * - Hard
             */
            $table->enum('difficulty', ['Easy', 'Medium', 'Hard']);

            /**
             * Ārējā atslēga uz users tabulu.
             *
             * Ja lietotājs tiek dzēsts,
             * tiek dzēstas arī viņa receptes.
             */
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            /**
             * Automātiski izveido created_at un updated_at laukus.
             */
            $table->timestamps();
        });
    }

    /**
     * Atceļ migrāciju un dzēš tabulu.
     */
    public function down(): void
    {
        /**
         * Tiek dzēsta newrecipes tabula.
         *
         * Piezīme:
         * Oriģinālajā failā bija norādīts recipes tabulas nosaukums,
         * taču korektais tabulas nosaukums ir newrecipes.
         */
        Schema::dropIfExists('newrecipes');
    }
};