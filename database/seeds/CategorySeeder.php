<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Baby Care',
                'slug' => 'baby-care',
            ],
            [
                'name' => 'Electronics',
                'slug' => 'electronics',
            ],
        ];
        
        foreach($categories as $category) {
            Category::create($category);
        }
    }
}
