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
        Schema::table('users', function (Blueprint $table) { // Modificē esošo 'users' tabulu
            $table->boolean('is_admin')->default(false); // Pievieno boolean lauku 'is_admin' ar noklusējuma vērtību false
        });
    }

    /**
     * Reverse the migrations. // Dokumentācijas komentārs par down metodi
     */
    public function down(): void // Metode, kas atceļ veiktās izmaiņas
    {
        Schema::table('users', function (Blueprint $table) { // Modificē esošo 'users' tabulu
            $table->dropColumn('is_admin'); // Dzēš 'is_admin' kolonnu
        });
    }
};


