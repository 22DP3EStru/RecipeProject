<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->string('image_path')->nullable();
            $table->string('video_path')->nullable();
            $table->string('video_url')->nullable();
        });
    }

    public function down(): void
    {
        // drop only if they exist
        if (Schema::hasColumn('recipes', 'video_url')) {
            Schema::table('recipes', fn (Blueprint $table) => $table->dropColumn('video_url'));
        }
        if (Schema::hasColumn('recipes', 'video_path')) {
            Schema::table('recipes', fn (Blueprint $table) => $table->dropColumn('video_path'));
        }
        if (Schema::hasColumn('recipes', 'image_path')) {
            Schema::table('recipes', fn (Blueprint $table) => $table->dropColumn('image_path'));
        }
    }
};