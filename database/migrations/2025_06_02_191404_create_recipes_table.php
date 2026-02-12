<?php // Norāda, ka šis ir PHP migrācijas fails

use Illuminate\Database\Migrations\Migration; // Iekļauj Migration bāzes klasi
use Illuminate\Database\Schema\Blueprint; // Iekļauj Blueprint klasi tabulu struktūras definēšanai
use Illuminate\Support\Facades\Schema; // Iekļauj Schema fasādi darbam ar datubāzes shēmu

return new class extends Migration // Definē anonīmu klasi, kas paplašina Migration
{
    public function up(): void // Metode, kas izveido tabulu datubāzē
    {
        Schema::create('recipes', function (Blueprint $table) { // Izveido 'recipes' tabulu
            $table->id(); // Izveido primāro atslēgu (auto increment ID)
            $table->string('title'); // Izveido receptes nosaukuma lauku
            $table->text('description'); // Izveido receptes apraksta lauku
            $table->text('ingredients'); // Izveido sastāvdaļu lauku
            $table->text('instructions'); // Izveido pagatavošanas instrukciju lauku
            $table->integer('prep_time')->nullable(); // Izveido sagatavošanas laika lauku (var būt NULL)
            $table->integer('cook_time')->nullable(); // Izveido gatavošanas laika lauku (var būt NULL)
            $table->integer('servings')->nullable(); // Izveido porciju skaita lauku (var būt NULL)
            $table->string('difficulty')->nullable(); // Izveido sarežģītības līmeņa lauku (var būt NULL)
            $table->string('category')->nullable(); // Izveido kategorijas nosaukuma lauku (var būt NULL)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Izveido ārējo atslēgu uz users tabulu ar dzēšanas kaskādi
            $table->timestamps(); // Izveido created_at un updated_at laukus
        });
    }

    public function down(): void // Metode, kas atceļ migrāciju (dzēš tabulu)
    {
        Schema::dropIfExists('recipes'); // Dzēš 'recipes' tabulu, ja tā eksistē
    }
};
