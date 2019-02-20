<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		// Truncate Users table to start from zero on each seed
		User::truncate();

		// Use of factory to seed users
		factory(User::class, 10)->create();
    }
}
