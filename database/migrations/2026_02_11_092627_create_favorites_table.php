<?php // Norāda, ka šis ir PHP migrācijas fails

use Illuminate\Database\Migrations\Migration; // Iekļauj Migration bāzes klasi
use Illuminate\Database\Schema\Blueprint; // Iekļauj Blueprint klasi tabulu struktūras definēšanai
use Illuminate\Support\Facades\Schema; // Iekļauj Schema fasādi darbam ar datubāzes shēmu

return new class extends Migration { // Definē anonīmu klasi, kas paplašina Migration
    public function up(): void // Metode, kas izveido tabulu datubāzē
    {
        Schema::create('favorites', function (Blueprint $table) { // Izveido 'favorites' pivot tabulu
            $table->id(); // Izveido primāro atslēgu (auto increment ID)
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Izveido ārējo atslēgu uz users tabulu ar dzēšanas kaskādi
            $table->foreignId('recipe_id')->constrained()->cascadeOnDelete(); // Izveido ārējo atslēgu uz recipes tabulu ar dzēšanas kaskādi
            $table->timestamps(); // Izveido created_at un updated_at laukus

            $table->unique(['user_id', 'recipe_id']); // Nodrošina, ka viens lietotājs nevar pievienot vienu un to pašu recepti favorītiem vairākas reizes
        });
    }

    public function down(): void // Metode, kas atceļ migrāciju (dzēš tabulu)
    {
        Schema::dropIfExists('favorites'); // Dzēš 'favorites' tabulu, ja tā eksistē
    }
};
