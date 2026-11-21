<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
   
    public function run(): void
    {
        $categories = [
            ['name' => '文房具'],
            ['name' => 'OA用品'],
            ['name' => '日用品'],
            ['name' => '飲料・食品'],
            ['name' => '清掃用品'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}