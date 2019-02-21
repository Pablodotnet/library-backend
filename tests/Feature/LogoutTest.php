<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class LogoutTest extends TestCase
{
	/**
	 * Test request without token
	 * 
	 */
	public function testRequestWithoutToken()
	{
		// We simulate the login
		$user = factory(User::class)->create(['email' => 'testing@user.com']);
		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		// Now we simulate the logout
		$user->api_token = null;
		$user->save();

		// Now we try to get api books but it will fail because it is not logged in
		// (it does not have token)
		$this->json('get', '/api/books', [], $headers)->assertStatus(401);
	}

    /**
     * Testing successful logout.
     *
     */
    public function testSuccesfulUserLogout()
    {
		$user = factory(User::class)->create(['email' => 'testing@user.com']);
		$token = $user->generateToken();
		$headers = ['Authorization' => "Bearer $token"];

		// Get api books just to test if is successfully logged in with api_token
		$this->json('get', '/api/books', [], $headers)->assertStatus(200);
		$this->json('post', '/api/logout', [], $headers)->assertStatus(200);

		$user = User::find($user->id);
		
		// As the user has logged out successfully, he should not have api_token anymore
		$this->assertEquals(null, $user->api_token);
    }
}
