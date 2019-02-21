<?php

use Illuminate\Database\Seeder;
use App\Category;
use Faker\Generator as Faker;
use Carbon\Carbon;
use App\Book;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
		// Truncate Categories tables to start from zero each seed
		Category::truncate();

		// Seed established categories
		$categories = ['Thriller', 'Drama', 'Science', 'History', 'Kids', 'Western', 'Romance'];

		foreach ($categories as $category) {
			DB::table('categories')->insert([
				'name'				=> $category,
				'description'		=> $faker->text($maxNbChars = 150),
				'created_at' 		=> Carbon::now(),
				'updated_at' 		=> Carbon::now(),
			]);
		}
    }
}
