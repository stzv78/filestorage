<?php

use Faker\Generator as Faker;

$factory->define(App\Models\File::class, function (Faker $faker) {
    return [
        'description' => $faker->description,
        'hash_user' => $faker->unique()->safeEmail,
        'hash_file' => str_random(32),
    ];
});
