<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegisterTest extends TestCase
{
	/**
	 * Testing registration without required fields
	 * 
	 */
	public function testRegistrationWithoutRequiredFields()
	{
		$this->json('POST', '/register')
			->assertStatus(422)
			->assertJson([
				'name' => ['The name field is required.'],
				'email' => ['The email field is required.'],
				'password' => ['The password field is required.'],
			]);
	}

	/**
	 * Testing registration without password confirmation
	 * 
	 */
	public function testRegistrationWithoutPasswordConfirmation()
	{
		$payload = [
			'name' => 'Test',
			'email' => 'testing@user.com',
			'password' => 'testing123',
		];

		$this->json('POST', '/register', $payload)
			->assertStatus(422)
			->assertJson([
				'password' => ['The password confirmation does not match.'],
			]);
	}

    /**
     * Testing successful registration.
     *
     */
    public function testSuccessfulRegistration()
    {
        $payload = [
			'name' => 'Test',
			'email' => 'testing@user.com',
			'password' => 'testing123',
			'password_confirmation' => 'testing123',
		];

		$this->json('POST', '/register', $payload)
			->assertStatus(302)
			->assertRedirect('/home');
    }
}
