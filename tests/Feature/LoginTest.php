<?php

namespace Tests\Feature\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class LoginTest extends TestCase
{
    /**
     * Testing login without required fields (email and password).
     *
     */
    public function testLoginWithoutRequiredFields()
    {
		$this->json('POST', 'api/login')
			->assertStatus(422)
			->assertJson([
				'email' => ['The email field is required.'],
				'password' => ['The password field is required.'],
			]);
	}
	
	/**
	 * Testing successful login
	 * 
	 */
	public function testUserSuccessfulLogin()
	{
		$user = factory(User::class)->create([
			'email' => 'test@user.com',
			'password' => bcrypt('testing123'),
		]);

		$payload = ['email' => 'test@user.com', 'password' => 'testing123'];

		$this->json('POST', 'api/login', $payload)
			->assertStatus(200)
			->assertJsonStructure([
				'data' => [
					'id',
					'name',
					'email',
					'created_at',
					'updated_at',
					'api_token',
				],
			]);
	}
}
