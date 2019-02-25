<?php

use Illuminate\Database\Seeder;
use App\Book;
use App\Category;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// Truncate of Book table to start from zero each seed
		Book::truncate();
		
		// Get all categories
		$categories = Category::all();

		// Using factory to create the books
		factory(Book::class, 50)->create()->each(function($book) use ($categories) {
			$categories->random()->books()->save($book);
		});
    }
}
