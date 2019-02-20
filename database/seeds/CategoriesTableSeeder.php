<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// Truncate Categories tables to start from zero each seed
		Category::truncate();

		// Use factory to seed categories
		factory(Category::class, 30)->create();
    }
}
