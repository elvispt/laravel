<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
use App\Models\User;

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Note::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function () {
            return (new User())->inRandomOrder()->first()->id;
        },
        'note' => $faker->text(400),
    ];
});

$factory->define(App\Models\Tag::class, function (Faker\Generator $faker) {
    return [
        'user_id' => function () {
            return (new User())->inRandomOrder()->first()->id;
        },
        'tag' => $faker->unique()->word,
    ];
});
