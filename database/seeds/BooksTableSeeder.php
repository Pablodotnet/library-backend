<?php

use Illuminate\Database\Seeder;
use App\Book;

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

		// Using factory to create the books
		factory(Book::class, 50)->create();
    }
}
