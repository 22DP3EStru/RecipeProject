<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('ingredients');
            $table->text('instructions');
            $table->integer('prep_time')->nullable();
            $table->integer('cook_time')->nullable();
            $table->integer('servings')->nullable();
            $table->string('difficulty')->nullable();
            $table->string('category')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};

