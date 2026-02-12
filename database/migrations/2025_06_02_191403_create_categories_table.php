<?php // Norāda, ka šis ir PHP migrācijas fails

use Illuminate\Database\Migrations\Migration; // Iekļauj Migration bāzes klasi
use Illuminate\Database\Schema\Blueprint; // Iekļauj Blueprint klasi tabulu struktūras definēšanai
use Illuminate\Support\Facades\Schema; // Iekļauj Schema fasādi darbam ar datubāzes shēmu

return new class extends Migration { // Definē anonīmu klasi, kas paplašina Migration
    public function up(): void { // Metode, kas izveido tabulu datubāzē
        Schema::create('categories', function (Blueprint $table) { // Izveido 'categories' tabulu
            $table->id(); // Izveido primāro atslēgu (auto increment ID)
            $table->string('name'); // Izveido kategorijas nosaukuma lauku
            $table->timestamps(); // Izveido created_at un updated_at laukus
        });
    }

    public function down(): void { // Metode, kas atceļ migrāciju (dzēš tabulu)
        Schema::dropIfExists('categories'); // Dzēš 'categories' tabulu, ja tā eksistē
    }
};


