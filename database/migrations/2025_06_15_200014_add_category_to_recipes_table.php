<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->string('category')->nullable()->after('description');
            $table->string('difficulty')->nullable()->after('category');
            $table->integer('servings')->nullable()->after('difficulty');
            $table->integer('prep_time')->nullable()->after('servings');
            $table->integer('cook_time')->nullable()->after('prep_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn(['category', 'difficulty', 'servings', 'prep_time', 'cook_time']);
        });
    }
};
