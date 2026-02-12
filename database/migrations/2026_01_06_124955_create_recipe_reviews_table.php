<?php // Norāda, ka šis ir PHP migrācijas fails

use Illuminate\Database\Migrations\Migration; // Iekļauj Migration bāzes klasi
use Illuminate\Database\Schema\Blueprint; // Iekļauj Blueprint klasi tabulu struktūras definēšanai
use Illuminate\Support\Facades\Schema; // Iekļauj Schema fasādi darbam ar datubāzes shēmu

return new class extends Migration { // Definē anonīmu klasi, kas paplašina Migration
    public function up(): void // Metode, kas izveido tabulu datubāzē
    {
        Schema::create('recipe_reviews', function (Blueprint $table) { // Izveido 'recipe_reviews' tabulu
            $table->id(); // Izveido primāro atslēgu (auto increment ID)

            $table->foreignId('recipe_id')->constrained()->cascadeOnDelete(); // Izveido ārējo atslēgu uz recipes tabulu ar dzēšanas kaskādi
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Izveido ārējo atslēgu uz users tabulu ar dzēšanas kaskādi

            $table->unsignedTinyInteger('rating'); // Izveido vērtējuma lauku (1..5)
            $table->text('comment')->nullable(); // Izveido komentāra lauku (var būt NULL)

            $table->timestamps(); // Izveido created_at un updated_at laukus

            // 1 atsauksme uz 1 recepti katram lietotājam
            $table->unique(['recipe_id', 'user_id']); // Nodrošina, ka viens lietotājs var atstāt tikai vienu atsauksmi par konkrētu recepti
        });
    }

    public function down(): void // Metode, kas atceļ migrāciju (dzēš tabulu)
    {
        Schema::dropIfExists('recipe_reviews'); // Dzēš 'recipe_reviews' tabulu, ja tā eksistē
    }
};


