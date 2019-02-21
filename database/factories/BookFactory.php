<?php

use Faker\Generator as Faker;

$factory->define(App\Book::class, function (Faker $faker) {
	return [
		'name'				=> $faker->sentence($nbWords = 6, $variableNbWords = true),
		'author'			=> $faker->name,
		'published_date'	=> $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
	];
});