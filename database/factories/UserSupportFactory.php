<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserSupport;
use Faker\Generator as Faker;

$factory->define(UserSupport::class, function (Faker $faker) {
    return [
        'names' => $this->faker->name,
        'email' => $this->faker->unique()->safeEmail,
        'phone' => $this->faker->phoneNumber,
        'jobtitle' => $this->faker->title,
        'eps' => Str::random(10),
        'type' => Str::random(10),
        'message' => $this->faker->paragraph,
        //
    ];
});
