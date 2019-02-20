<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		if (app()->environment("local")) {
			$this->call('UsersTableSeeder');
			$this->call('BooksTableSeeder');
			$this->call('CategoriesTableSeeder');
		}

		if (app()->environment("testing")) {
			$this->call('TestingSeeder');
		}
    }
}
