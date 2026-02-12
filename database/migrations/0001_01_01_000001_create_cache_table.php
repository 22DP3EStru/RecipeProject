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
        Schema::create('cache', function (Blueprint $table) { // Izveido 'cache' tabulu
            $table->string('key')->primary(); // Izveido atslēgas lauku kā primāro atslēgu
            $table->mediumText('value'); // Izveido lauku kešatmiņas datu glabāšanai
            $table->integer('expiration'); // Izveido lauku, kas glabā derīguma termiņu (timestamp)
        });

        Schema::create('cache_locks', function (Blueprint $table) { // Izveido 'cache_locks' tabulu
            $table->string('key')->primary(); // Izveido atslēgas lauku kā primāro atslēgu
            $table->string('owner'); // Izveido lauku, kas norāda bloķējuma īpašnieku
            $table->integer('expiration'); // Izveido lauku bloķējuma derīguma termiņam
        });
    }

    /**
     * Reverse the migrations. // Dokumentācijas komentārs par down metodi
     */
    public function down(): void // Metode, kas atceļ migrāciju (dzēš tabulas)
    {
        Schema::dropIfExists('cache'); // Dzēš 'cache' tabulu, ja tā eksistē
        Schema::dropIfExists('cache_locks'); // Dzēš 'cache_locks' tabulu, ja tā eksistē
    }
};


