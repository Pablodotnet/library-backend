<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Book;

class BookTest extends TestCase
{
    /**
     * Testing successful book creation
     *
     */
    public function testSuccessfulBookCreation()
    {
		$user = factory(User::class)->create();
		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		$payload = [
			'name' => 'One book',
			'author' => 'One author',
			'published_date' => '2018-09-02 08:07:56',
		];

		$this->json('POST', '/api/books', $payload, $headers)
			->assertStatus(201)
			->assertJson([
				'id' => 1,
				'name' => 'One book',
				'author' => 'One author',
				'published_date' => '2018-09-02 08:07:56',
			]);
	}
	
	/**
	 * Test successful book update
	 * 
	 */
	public function testSuccessfulBookUpdate()
	{
		$user = factory(User::class)->create();
		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		$book = factory(Book::class)->create([
			'name' => 'Another book',
			'author' => 'Another author',
			'published_date' => '2017-09-02 08:07:06',
		]);

		$payload = [
			'name' => 'Edited book name',
			'author' => 'Edited author name',
			'published_date' => '2018-08-08 09:09:09',
		];

		$response = $this->json('PUT', '/api/books/' . $book->id, $payload, $headers)
			->assertStatus(200)
			->assertJson([
				'id' => 1,
				'name' => 'Edited book name',
				'author' => 'Edited author name',
				'published_date' => '2018-08-08 09:09:09',
			]);
	}

	/**
	 * Test successful book deletion
	 * 
	 */
	public function testSuccesfulBookDeletion()
	{
		$user = factory(User::class)->create();
		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		$book = factory(Book::class)->create([
			'name' => 'New book',
			'author' => 'New author',
			'published_date' => '2018-08-08 09:09:09',
		]);

		$this->json('delete', '/api/books/' . $book->id, [], $headers)
			->assertStatus(204);
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
		]);

		factory(Book::class)->create([
			'name' => 'A cool book',
			'author' => 'A cool author',
			'published_date' => '2017-07-07 08:08:08',
		]);

		$user = factory(User::class)->create();
		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		$response = $this->json('GET', '/api/books', [], $headers)
			->assertStatus(200)
			->assertJson([
				[ 'name' => 'A book', 'author' => 'An author', 'published_date' => '2018-08-08 09:09:09' ],
				[ 'name' => 'A cool book', 'author' => 'A cool author', 'published_date' => '2017-07-07 08:08:08' ]
			])
			->assertJsonStructure([
				'*' => [ 'id', 'name', 'author', 'published_date', 'created_at', 'updated_at' ],
			]);
	}
}
