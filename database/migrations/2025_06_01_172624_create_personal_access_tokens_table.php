<?php

/**
 * Šī migrācija izveido personal_access_tokens tabulu
 * recepšu tīmekļa vietnes API autentifikācijas vajadzībām.
 *
 * Migrācija atbild par:
 * - personīgo piekļuves tokenu glabāšanu;
 * - API autentifikācijas struktūras sagatavošanu;
 * - tokenu atļauju glabāšanu;
 * - tokenu derīguma termiņu pārvaldību;
 * - polymorphic relāciju nodrošināšanu;
 * - tabulas dzēšanu migrācijas atcelšanas gadījumā.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Izveido personal_access_tokens tabulu.
     */
    public function up(): void
    {
        /**
         * Tiek izveidota personal_access_tokens tabula,
         * kurā tiek glabāti API autentifikācijas tokeni.
         */
        Schema::create('personal_access_tokens', function (Blueprint $table) {

            /**
             * Primārā atslēga ar automātisku ID pieaugumu.
             */
            $table->id();

            /**
             * Tiek izveidoti polymorphic relācijas lauki:
             * tokenable_id un tokenable_type.
             *
             * Tie ļauj tokenu piesaistīt dažādiem modeļiem.
             */
            $table->morphs('tokenable');

            /**
             * Tokena nosaukums.
             */
            $table->string('name');

            /**
             * Unikāla tokena vērtība ar 64 simbolu garumu.
             */
            $table->string('token', 64)->unique();

            /**
             * Tokenam piešķirtās atļaujas.
             * Var saturēt NULL vērtību.
             */
            $table->text('abilities')->nullable();

            /**
             * Tokena pēdējās izmantošanas laiks.
             * Var saturēt NULL vērtību.
             */
            $table->timestamp('last_used_at')->nullable();

            /**
             * Tokena derīguma termiņš.
             * Var saturēt NULL vērtību.
             */
            $table->timestamp('expires_at')->nullable();

            /**
             * Automātiski izveido created_at un updated_at laukus.
             */
            $table->timestamps();
        });
    }

    /**
     * Atceļ migrāciju un dzēš personal_access_tokens tabulu.
     */
    public function down(): void
    {
        /**
         * Tiek dzēsta personal_access_tokens tabula.
         */
        Schema::dropIfExists('personal_access_tokens');
    }
};