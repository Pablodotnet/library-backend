<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
	return [
		'name'				=> $faker->sentence($nbWords = 3, $variableNbWords = true),
		'author'			=> $faker->name,
		'published_date'	=> $faker->date($format = 'Y-m-d', $max = 'now'),
	];
});
