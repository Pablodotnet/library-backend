<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
	return [
		'name'				=> $faker->sentence($nbWords = 2, $variableNbWords = true),
		'description'		=> $faker->text($maxNbChars = 200),
	];
});
