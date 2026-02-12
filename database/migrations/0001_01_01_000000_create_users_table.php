<?php // Norāda, ka šis ir PHP migrācijas fails

use Illuminate\Database\Migrations\Migration; // Iekļauj Migration bāzes klasi
use Illuminate\Database\Schema\Blueprint; // Iekļauj Blueprint klasi tabulu struktūras definēšanai
use Illuminate\Support\Facades\Schema; // Iekļauj Schema fasādi darbam ar datubāzes shēmu

return new class extends Migration // Definē anonīmu klasi, kas paplašina Migration
{
    /**
     * Run the migrations. // Dokumentācijas komentārs par up metodi
     */
    public function up(): void // Metode, kas izveido tabulas datubāzē
    {
        Schema::create('users', function (Blueprint $table) { // Izveido 'users' tabulu
            $table->id(); // Izveido primāro atslēgu (auto increment ID)
            $table->string('name'); // Izveido name lauku (teksta tips)
            $table->string('email')->unique(); // Izveido unikālu email lauku
            $table->timestamp('email_verified_at')->nullable(); // Izveido e-pasta apstiprināšanas lauku (var būt NULL)
            $table->string('password'); // Izveido password lauku
            $table->rememberToken(); // Izveido remember_token lauku autentifikācijai
            $table->timestamps(); // Izveido created_at un updated_at laukus
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) { // Izveido 'password_reset_tokens' tabulu
            $table->string('email')->primary(); // Izveido email lauku kā primāro atslēgu
            $table->string('token'); // Izveido token lauku paroles atiestatīšanai
            $table->timestamp('created_at')->nullable(); // Izveido tokena izveides laiku (var būt NULL)
        });

        Schema::create('sessions', function (Blueprint $table) { // Izveido 'sessions' tabulu
            $table->string('id')->primary(); // Izveido sesijas ID kā primāro atslēgu
            $table->foreignId('user_id')->nullable()->index(); // Izveido ārējo atslēgu uz users tabulu (var būt NULL)
            $table->string('ip_address', 45)->nullable(); // Izveido IP adreses lauku (maks. 45 simboli, IPv6 atbalsts)
            $table->text('user_agent')->nullable(); // Izveido pārlūka informācijas lauku
            $table->longText('payload'); // Izveido sesijas datu lauku
            $table->integer('last_activity')->index(); // Izveido pēdējās aktivitātes lauku ar indeksu
        });
    }

    /**
     * Reverse the migrations. // Dokumentācijas komentārs par down metodi
     */
    public function down(): void // Metode, kas atceļ migrāciju (dzēš tabulas)
    {
        Schema::dropIfExists('users'); // Dzēš 'users' tabulu, ja tā eksistē
        Schema::dropIfExists('password_reset_tokens'); // Dzēš 'password_reset_tokens' tabulu, ja tā eksistē
        Schema::dropIfExists('sessions'); // Dzēš 'sessions' tabulu, ja tā eksistē
    }
};
