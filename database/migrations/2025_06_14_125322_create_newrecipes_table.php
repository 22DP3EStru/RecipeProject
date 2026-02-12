<?php // Norāda, ka šis ir PHP migrācijas fails

use Illuminate\Database\Migrations\Migration; // Iekļauj Migration bāzes klasi
use Illuminate\Database\Schema\Blueprint; // Iekļauj Blueprint klasi tabulu struktūras definēšanai
use Illuminate\Support\Facades\Schema; // Iekļauj Schema fasādi darbam ar datubāzes shēmu

return new class extends Migration // Definē anonīmu klasi, kas paplašina Migration
{
    /**
     * Run the migrations. // Dokumentācijas komentārs par up metodi
     */
    public function up(): void // Metode, kas izveido tabulu datubāzē
    {
        Schema::create('newrecipes', function (Blueprint $table) { // Izveido 'newrecipes' tabulu
            $table->id(); // Izveido primāro atslēgu (auto increment ID)
            $table->string('title'); // Izveido receptes nosaukuma lauku
            $table->text('description'); // Izveido receptes apraksta lauku
            $table->text('ingredients'); // Izveido sastāvdaļu lauku
            $table->text('instructions'); // Izveido pagatavošanas instrukciju lauku
            $table->string('category'); // Izveido kategorijas lauku
            $table->integer('prep_time')->nullable(); // Izveido sagatavošanas laiku (var būt NULL)
            $table->integer('cook_time')->nullable(); // Izveido gatavošanas laiku (var būt NULL)
            $table->integer('servings')->nullable(); // Izveido porciju skaitu (var būt NULL)
            $table->enum('difficulty', ['Easy', 'Medium', 'Hard']); // Izveido sarežģītības lauku ar fiksētām vērtībām
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Izveido ārējo atslēgu uz users tabulu ar dzēšanas kaskādi
            $table->timestamps(); // Izveido created_at un updated_at laukus
        });
    }

    /**
     * Reverse the migrations. // Dokumentācijas komentārs par down metodi
     */
    public function down(): void // Metode, kas atceļ migrāciju
    {
        Schema::dropIfExists('recipes'); // Dzēš 'recipes' tabulu (PIEZĪME: šeit nosaukums neatbilst 'newrecipes')
    }
};
