<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->string('image_path')->nullable()->after('description');
            $table->string('image_url')->nullable()->after('image_path');
            $table->string('video_path')->nullable()->after('image_url');
            $table->string('video_url')->nullable()->after('video_path');
        });
    }

    public function down(): void
    {
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn([
                'image_path',
                'image_url',
                'video_path',
                'video_url'
            ]);
        });
    }
};