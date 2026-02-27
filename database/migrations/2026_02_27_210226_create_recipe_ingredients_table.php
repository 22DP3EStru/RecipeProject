<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('recipe_ingredients', function (Blueprint $table) {

            $table->id();

            // Piesaista recepti
            $table->foreignId('recipe_id')
                  ->constrained('recipes')
                  ->onDelete('cascade');

            // Sastāvdaļas nosaukums (piemēram "Milti")
            $table->string('name');

            // Daudzums (piemēram 200.000)
            $table->decimal('quantity', 10, 2)->nullable();

            // Mērvienība (piemēram "g", "ml", "gab")
            $table->string('unit', 30)->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipe_ingredients');
    }
};