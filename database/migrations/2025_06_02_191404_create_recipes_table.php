<?php

/**
 * Šī migrācija izveido recipes tabulu
 * recepšu tīmekļa vietnes datubāzē.
 *
 * Migrācija atbild par:
 * - recepšu datu glabāšanas struktūras izveidi;
 * - receptes pamatinformācijas saglabāšanu;
 * - receptes sasaisti ar lietotāju;
 * - sagatavošanas un gatavošanas datu glabāšanu;
 * - kategorijas un sarežģītības informācijas saglabāšanu;
 * - automātisko laika zīmogu izveidi;
 * - tabulas dzēšanu migrācijas atcelšanas gadījumā.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Izveido recipes tabulu.
     */
    public function up(): void
    {
        /**
         * Tiek izveidota recipes tabula,
         * kurā tiek glabātas receptes.
         */
        Schema::create('recipes', function (Blueprint $table) {

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
             * Var saturēt NULL vērtību.
             */
            $table->string('difficulty')->nullable();

            /**
             * Receptes kategorijas nosaukums.
             * Var saturēt NULL vērtību.
             */
            $table->string('category')->nullable();

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
     * Atceļ migrāciju un dzēš recipes tabulu.
     */
    public function down(): void
    {
        /**
         * Tiek dzēsta recipes tabula.
         */
        Schema::dropIfExists('recipes');
    }
};