<?php // Norāda, ka šis ir PHP migrācijas fails

use Illuminate\Database\Migrations\Migration; // Iekļauj Migration bāzes klasi
use Illuminate\Database\Schema\Blueprint; // Iekļauj Blueprint klasi tabulu struktūras definēšanai
use Illuminate\Support\Facades\Schema; // Iekļauj Schema fasādi darbam ar datubāzes shēmu

return new class extends Migration // Definē anonīmu klasi, kas paplašina Migration
{
    /**
     * Run the migrations. // Dokumentācijas komentārs par up metodi
     */
    public function up(): void // Metode, kas izveido tabulas datubāzē
    {
        Schema::create('jobs', function (Blueprint $table) { // Izveido 'jobs' tabulu rindas apstrādei (queue)
            $table->id(); // Izveido primāro atslēgu (auto increment ID)
            $table->string('queue')->index(); // Izveido rindas nosaukumu ar indeksu
            $table->longText('payload'); // Saglabā darba datus (serializētā formā)
            $table->unsignedTinyInteger('attempts'); // Saglabā mēģinājumu skaitu
            $table->unsignedInteger('reserved_at')->nullable(); // Laiks, kad darbs rezervēts (var būt NULL)
            $table->unsignedInteger('available_at'); // Laiks, kad darbs pieejams izpildei
            $table->unsignedInteger('created_at'); // Darba izveides laiks
        });

        Schema::create('job_batches', function (Blueprint $table) { // Izveido 'job_batches' tabulu partiju apstrādei
            $table->string('id')->primary(); // Izveido partijas ID kā primāro atslēgu
            $table->string('name'); // Partijas nosaukums
            $table->integer('total_jobs'); // Kopējais darbu skaits partijā
            $table->integer('pending_jobs'); // Neapstrādāto darbu skaits
            $table->integer('failed_jobs'); // Neveiksmīgo darbu skaits
            $table->longText('failed_job_ids'); // Saglabā neveiksmīgo darbu ID sarakstu
            $table->mediumText('options')->nullable(); // Papildu opcijas (var būt NULL)
            $table->integer('cancelled_at')->nullable(); // Atcelšanas laiks (var būt NULL)
            $table->integer('created_at'); // Partijas izveides laiks
            $table->integer('finished_at')->nullable(); // Partijas pabeigšanas laiks (var būt NULL)
        });

        Schema::create('failed_jobs', function (Blueprint $table) { // Izveido 'failed_jobs' tabulu neveiksmīgajiem darbiem
            $table->id(); // Izveido primāro atslēgu
            $table->string('uuid')->unique(); // Izveido unikālu darba UUID
            $table->text('connection'); // Saglabā savienojuma nosaukumu
            $table->text('queue'); // Saglabā rindas nosaukumu
            $table->longText('payload'); // Saglabā darba datus
            $table->longText('exception'); // Saglabā kļūdas informāciju (exception)
            $table->timestamp('failed_at')->useCurrent(); // Saglabā neveiksmes laiku (automātiski pašreizējais laiks)
        });
    }

    /**
     * Reverse the migrations. // Dokumentācijas komentārs par down metodi
     */
    public function down(): void // Metode, kas atceļ migrāciju (dzēš tabulas)
    {
        Schema::dropIfExists('jobs'); // Dzēš 'jobs' tabulu, ja tā eksistē
        Schema::dropIfExists('job_batches'); // Dzēš 'job_batches' tabulu, ja tā eksistē
        Schema::dropIfExists('failed_jobs'); // Dzēš 'failed_jobs' tabulu, ja tā eksistē
    }
};
