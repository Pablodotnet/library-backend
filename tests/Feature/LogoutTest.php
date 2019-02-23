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
     * Testing successful logout.
     *
     */
    public function testSuccesfulUserLogout()
    {
		$user = factory(User::class)->create(['email' => 'testing@user.com']);

		// Get api books just to test if is successfully logged in with api_token
		$this->actingAs($user, 'api')->json('get', '/books', [])->assertStatus(200);
		$this->actingAs($user, 'api')->json('post', '/logout', [])
			->assertStatus(302)
			->assertRedirect('/');
    }
}
