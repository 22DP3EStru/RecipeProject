<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Brokastis', 'Pusdienas', 'Vakariņas', 'Uzkodas', 'Deserti', 'Vegan', 'Bezglutēna'];

        foreach ($categories as $c) {
            Category::create([
                'name' => $c,
                'slug' => Str::slug($c),
            ]);
        }
    }
}