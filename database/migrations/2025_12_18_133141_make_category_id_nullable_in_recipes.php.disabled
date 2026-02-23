<?php // Norāda, ka šis ir PHP migrācijas fails

use Illuminate\Database\Migrations\Migration; // Iekļauj Migration bāzes klasi
use Illuminate\Database\Schema\Blueprint; // Iekļauj Blueprint klasi tabulu struktūras izmaiņām
use Illuminate\Support\Facades\Schema; // Iekļauj Schema fasādi darbam ar datubāzes shēmu

return new class extends Migration // Definē anonīmu klasi, kas paplašina Migration
{
    public function up() // Metode, kas veic izmaiņas datubāzē
    {
        Schema::table('recipes', function (Blueprint $table) { // Modificē esošo 'recipes' tabulu
            $table->unsignedBigInteger('category_id')->nullable()->change(); // Maina 'category_id' kolonnu uz unsignedBigInteger un atļauj NULL vērtības
        });
    }

    public function down(): void // Metode, kas atceļ veiktās izmaiņas
    {
        Schema::table('recipes', function (Blueprint $table) { // Modificē esošo 'recipes' tabulu
            // // Šeit nav definēta pretēja izmaiņa (kolonna netiek atjaunota iepriekšējā stāvoklī)
        });
    }
};
