<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

// database/seeders/CategorySeeder.php
class CategorySeeder extends Seeder
{
    public function run()
    {
        collect(['Brokastis','Pusdienas','Vakariņas','Deserti'])
            ->each(fn($c)=>\App\Models\Category::create([
               'name'=>$c,
               'slug'=>Str::slug($c),
            ]));
    }
}

