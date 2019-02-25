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
		$this->json('POST', '/login')
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

		$this->json('POST', '/login', $payload)
			->assertStatus(302)
			->assertRedirect('/home');
	}
}
