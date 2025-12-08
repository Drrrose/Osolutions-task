<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Category::insert([
            ['name' => 'Work','color' => '#20bb30ff', 'image_filter' => 'office'],
            ['name' => 'Health','color' => '#73e7ccff', 'image_filter' => 'fitness'],
            ['name' => 'Finance','color' => '#19fb11ff', 'image_filter' => 'money'],
            ['name' => 'Education', 'color' => '#f59e0b', 'image_filter' => 'books'],
            ['name' => 'Travel','color' => '#06b6d4', 'image_filter' => 'travel'],
            ['name' => 'Home','color' => '#6366f1', 'image_filter' => 'house'],
            ['name' => 'Social','color' => '#886de8ff', 'image_filter' => 'party'],
            ['name' => 'Urgent', 'color' => '#dc2626', 'image_filter' => 'alert'],
            ['name' => 'Ideas', 'color' => '#f97316', 'image_filter' => 'art'],
            ['name' => 'Cooking','color' => '#c45f7aff', 'image_filter' => 'food'],
            ['name' => 'Pets', 'color' => '#b28f4cff', 'image_filter' => 'animals'],
            ['name' => 'Shopping','color' => '#000000aa', 'image_filter' => 'store'],
        ]);

    }
}
