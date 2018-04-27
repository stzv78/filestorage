<?php

use Faker\Generator as Faker;

$factory->define(App\Models\File::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence(3),
        'hash_user' => hash('md5',$faker->safeEmail()),
        'hash_file' => str_random(32),
    ];
});
