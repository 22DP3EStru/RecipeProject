<?php

/**
 * Šī migrācija izveido darbu rindas (queue) sistēmas tabulas
 * recepšu tīmekļa vietnes datubāzē.
 *
 * Migrācija atbild par:
 * - jobs tabulas izveidi;
 * - job_batches tabulas izveidi;
 * - failed_jobs tabulas izveidi;
 * - fonā izpildāmo darbu glabāšanu;
 * - darbu partiju pārvaldību;
 * - neveiksmīgu darbu žurnalēšanu;
 * - tabulu dzēšanu migrācijas atcelšanas gadījumā.
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Izveido datubāzes tabulas.
     */
    public function up(): void
    {
        /**
         * Tiek izveidota jobs tabula,
         * kurā tiek glabāti rindā ievietotie darbi.
         */
        Schema::create('jobs', function (Blueprint $table) {

            /**
             * Primārā atslēga ar automātisku ID pieaugumu.
             */
            $table->id();

            /**
             * Darbu rindas nosaukums.
             */
            $table->string('queue')->index();

            /**
             * Serializēti darba dati.
             */
            $table->longText('payload');

            /**
             * Darba izpildes mēģinājumu skaits.
             */
            $table->unsignedTinyInteger('attempts');

            /**
             * Laiks, kad darbs rezervēts izpildei.
             * Var saturēt NULL vērtību.
             */
            $table->unsignedInteger('reserved_at')->nullable();

            /**
             * Laiks, kad darbs kļūst pieejams izpildei.
             */
            $table->unsignedInteger('available_at');

            /**
             * Darba izveides laiks.
             */
            $table->unsignedInteger('created_at');
        });

        /**
         * Tiek izveidota job_batches tabula,
         * kas paredzēta darbu partiju pārvaldībai.
         */
        Schema::create('job_batches', function (Blueprint $table) {

            /**
             * Partijas identifikators kā primārā atslēga.
             */
            $table->string('id')->primary();

            /**
             * Partijas nosaukums.
             */
            $table->string('name');

            /**
             * Kopējais darbu skaits partijā.
             */
            $table->integer('total_jobs');

            /**
             * Neizpildīto darbu skaits.
             */
            $table->integer('pending_jobs');

            /**
             * Neveiksmīgo darbu skaits.
             */
            $table->integer('failed_jobs');

            /**
             * Neveiksmīgo darbu identifikatoru saraksts.
             */
            $table->longText('failed_job_ids');

            /**
             * Papildu partijas opcijas.
             * Var saturēt NULL vērtību.
             */
            $table->mediumText('options')->nullable();

            /**
             * Partijas atcelšanas laiks.
             * Var saturēt NULL vērtību.
             */
            $table->integer('cancelled_at')->nullable();

            /**
             * Partijas izveides laiks.
             */
            $table->integer('created_at');

            /**
             * Partijas pabeigšanas laiks.
             * Var saturēt NULL vērtību.
             */
            $table->integer('finished_at')->nullable();
        });

        /**
         * Tiek izveidota failed_jobs tabula,
         * kurā tiek saglabāti neveiksmīgi izpildītie darbi.
         */
        Schema::create('failed_jobs', function (Blueprint $table) {

            /**
             * Primārā atslēga ar automātisku ID pieaugumu.
             */
            $table->id();

            /**
             * Unikāls darba identifikators.
             */
            $table->string('uuid')->unique();

            /**
             * Savienojuma nosaukums,
             * kuru izmantoja darba izpildei.
             */
            $table->text('connection');

            /**
             * Darbu rindas nosaukums.
             */
            $table->text('queue');

            /**
             * Serializēti darba dati.
             */
            $table->longText('payload');

            /**
             * Kļūdas informācija un exception dati.
             */
            $table->longText('exception');

            /**
             * Neveiksmīgās izpildes laiks.
             */
            $table->timestamp('failed_at')->useCurrent();
        });
    }

    /**
     * Atceļ migrāciju un dzēš izveidotās tabulas.
     */
    public function down(): void
    {
        /**
         * Tiek dzēsta jobs tabula.
         */
        Schema::dropIfExists('jobs');

        /**
         * Tiek dzēsta job_batches tabula.
         */
        Schema::dropIfExists('job_batches');

        /**
         * Tiek dzēsta failed_jobs tabula.
         */
        Schema::dropIfExists('failed_jobs');
    }
};