<?php // Norāda, ka šis ir PHP migrācijas fails

use Illuminate\Database\Migrations\Migration; // Iekļauj Migration bāzes klasi
use Illuminate\Database\Schema\Blueprint; // Iekļauj Blueprint klasi tabulu struktūras definēšanai
use Illuminate\Support\Facades\Schema; // Iekļauj Schema fasādi darbam ar datubāzes shēmu

return new class extends Migration { // Definē anonīmu klasi, kas paplašina Migration
    public function up(): void { // Metode, kas izveido tabulu datubāzē
        Schema::create('comments', function (Blueprint $table) { // Izveido 'comments' tabulu
            $table->id(); // Izveido primāro atslēgu (auto increment ID)
            $table->text('body'); // Izveido komentāra teksta lauku
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Izveido ārējo atslēgu uz users tabulu ar dzēšanas kaskādi
            $table->foreignId('recipe_id')->constrained()->onDelete('cascade'); // Izveido ārējo atslēgu uz recipes tabulu ar dzēšanas kaskādi
            $table->timestamps(); // Izveido created_at un updated_at laukus
        });
    }

    public function down(): void { // Metode, kas atceļ migrāciju (dzēš tabulu)
        Schema::dropIfExists('comments'); // Dzēš 'comments' tabulu, ja tā eksistē
    }
};


