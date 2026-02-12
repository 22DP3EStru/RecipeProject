<?php // Norāda, ka šis ir PHP migrācijas fails

use Illuminate\Database\Migrations\Migration; // Iekļauj Migration bāzes klasi
use Illuminate\Database\Schema\Blueprint; // Iekļauj Blueprint klasi tabulu struktūras izmaiņām
use Illuminate\Support\Facades\Schema; // Iekļauj Schema fasādi darbam ar datubāzes shēmu

return new class extends Migration { // Definē anonīmu klasi, kas paplašina Migration
    public function up(): void { // Metode, kas veic izmaiņas datubāzē
        Schema::table('recipes', function (Blueprint $table) { // Modificē esošo 'recipes' tabulu
            $table->text('ingredients')->nullable()->after('description'); // Pievieno 'ingredients' kolonnu pēc 'description', var būt NULL
            $table->text('instructions')->nullable()->after('ingredients'); // Pievieno 'instructions' kolonnu pēc 'ingredients', var būt NULL
        });
    }

    public function down(): void { // Metode, kas atceļ veiktās izmaiņas
        Schema::table('recipes', function (Blueprint $table) { // Modificē esošo 'recipes' tabulu
            $table->dropColumn(['ingredients', 'instructions']); // Dzēš 'ingredients' un 'instructions' kolonnas
        });
    }
};


