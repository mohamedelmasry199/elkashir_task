<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Category::factory(5)->create()->each(function ($category) {
            SubCategory::factory(3)->create(['category_id' => $category->id]);
        });
    }
}
