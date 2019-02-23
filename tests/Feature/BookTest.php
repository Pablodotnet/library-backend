<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Book;
use App\Category;

class BookTest extends TestCase
{
    /**
     * Testing successful book creation
     *
     */
    public function testSuccessfulBookCreation()
    {
		$user = factory(User::class)->create();

		$payload = [
			'name' => 'One testing book',
			'author' => 'One author',
			'published_date' => '2018-09-02',
			'category' => 'Drama',
		];

		$response = $this->actingAs($user, 'api')->json('POST', '/books', $payload);
		$book = Book::where('name', $payload['name'])->firstOrFail();

		$response->assertStatus(302)
				->assertRedirect("/books/$book->id");
	}
	
	/**
	 * Test successful book update
	 * 
	 */
	public function testSuccessfulBookUpdate()
	{
		$user = factory(User::class)->create();

		$book = factory(Book::class)->create([
			'name' => 'Another book',
			'author' => 'Another author',
			'published_date' => '2017-09-02 08:07:06',
			'category_id' => '5',
		]);

		$payload = [
			'name' => 'Edited book name',
			'author' => 'Edited author name',
			'published_date' => '2018-08-08 09:09:09',
			'category' => 'Thriller',
		];

		$response = $this->actingAs($user, 'api')->json('PUT', "/books/$book->id", $payload);
		$response->assertStatus(302)
				->assertRedirect("/books/$book->id");
	}

	/**
	 * Test successful book deletion
	 * 
	 */
	public function testSuccesfulBookDeletion()
	{
		$user = factory(User::class)->create();

		$book = factory(Book::class)->create([
			'name' => 'New book',
			'author' => 'New author',
			'published_date' => '2018-08-08 09:09:09',
			'category_id' => '2',
		]);

		$response = $this->actingAs($user, 'api')->json('delete', "/books/$book->id", []);
		$response->assertStatus(302)
				->assertRedirect('/books');
	}

	/**
	 * Test correct list of books
	 * 
	 */
	public function testCorrectListBook()
	{
		factory(Book::class)->create([
			'name' => 'A book',
			'author' => 'An author',
			'published_date' => '2018-08-08 09:09:09',
			'category_id' => '2',
		]);

		factory(Book::class)->create([
			'name' => 'A cool book',
			'author' => 'A cool author',
			'published_date' => '2017-07-07 08:08:08',
			'category_id' => '3',
		]);

		$user = factory(User::class)->create();

		$response = $this->actingAs($user, 'api')->json('GET', '/books');
		$response->assertStatus(200);
	}

	/**
     * Testing return books view
     *
     */
	public function testBooksView()
	{
		$this->get('/books')
			->assertStatus(200)
			->assertViewIs('books');
	}
}
