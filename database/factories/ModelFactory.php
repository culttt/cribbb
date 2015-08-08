<?php

use Faker\Generator as Faker;

$factory->define('Cribbb\Users\User', function (Faker $faker) {
    return [
        'uuid'     => $faker->uuid,
        'name'     => $faker->name,
        'email'    => $faker->email,
        'password' => bcrypt(str_random(10))
    ];
});

$factory->define('Cribbb\Groups\Group', function (Faker $faker) {
    return [
        'uuid' => $faker->uuid,
        'name' => ucfirst($faker->word)
    ];
});
