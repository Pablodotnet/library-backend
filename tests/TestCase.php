<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use App\User;
use App\Book;

abstract class TestCase extends BaseTestCase
{
	use CreatesApplication, DatabaseMigrations;
	
	public function setUp()
	{
		parent::setUp();
		// Truncate user and book to reset sqlite db
		User::truncate();
		Book::truncate();
	}
}
