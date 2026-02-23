<?php // Norāda, ka šis ir PHP migrācijas fails

use Illuminate\Database\Migrations\Migration; // Iekļauj Migration bāzes klasi
use Illuminate\Database\Schema\Blueprint; // Iekļauj Blueprint klasi tabulu struktūras izmaiņām
use Illuminate\Support\Facades\Schema; // Iekļauj Schema fasādi darbam ar datubāzes shēmu

return new class extends Migration // Definē anonīmu klasi, kas paplašina Migration
{
    /**
     * Run the migrations. // Dokumentācijas komentārs par up metodi
     */
    public function up(): void // Metode, kas veic izmaiņas datubāzē
    {
        Schema::table('recipes', function (Blueprint $table) { // Modificē esošo 'recipes' tabulu
            $table->string('category')->nullable()->after('description'); // Pievieno 'category' kolonnu pēc 'description', var būt NULL
            $table->string('difficulty')->nullable()->after('category'); // Pievieno 'difficulty' kolonnu pēc 'category', var būt NULL
            $table->integer('servings')->nullable()->after('difficulty'); // Pievieno 'servings' kolonnu pēc 'difficulty', var būt NULL
            $table->integer('prep_time')->nullable()->after('servings'); // Pievieno 'prep_time' kolonnu pēc 'servings', var būt NULL
            $table->integer('cook_time')->nullable()->after('prep_time'); // Pievieno 'cook_time' kolonnu pēc 'prep_time', var būt NULL
        });
    }

    /**
     * Reverse the migrations. // Dokumentācijas komentārs par down metodi
     */
    public function down(): void // Metode, kas atceļ veiktās izmaiņas
    {
        Schema::table('recipes', function (Blueprint $table) { // Modificē esošo 'recipes' tabulu
            $table->dropColumn(['category', 'difficulty', 'servings', 'prep_time', 'cook_time']); // Dzēš pievienotās kolonnas
        });
    }
};

