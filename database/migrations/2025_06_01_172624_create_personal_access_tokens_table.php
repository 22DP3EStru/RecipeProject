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
        Schema::create('personal_access_tokens', function (Blueprint $table) { // Izveido 'personal_access_tokens' tabulu (API tokeniem)
            $table->id(); // Izveido primāro atslēgu (auto increment ID)
            $table->morphs('tokenable'); // Izveido polymorphic attiecību laukus (tokenable_id un tokenable_type)
            $table->string('name'); // Saglabā tokena nosaukumu
            $table->string('token', 64)->unique(); // Saglabā unikālu 64 simbolu tokena vērtību
            $table->text('abilities')->nullable(); // Saglabā tokena atļaujas (var būt NULL)
            $table->timestamp('last_used_at')->nullable(); // Saglabā pēdējās izmantošanas laiku (var būt NULL)
            $table->timestamp('expires_at')->nullable(); // Saglabā tokena derīguma termiņu (var būt NULL)
            $table->timestamps(); // Izveido created_at un updated_at laukus
        });
    }

    /**
     * Reverse the migrations. // Dokumentācijas komentārs par down metodi
     */
    public function down(): void // Metode, kas atceļ migrāciju (dzēš tabulu)
    {
        Schema::dropIfExists('personal_access_tokens'); // Dzēš 'personal_access_tokens' tabulu, ja tā eksistē
    }
};


