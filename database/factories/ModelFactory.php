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
    $created_at = $faker->dateTimeThisDecade();
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('secret'),
        'remember_token' => str_random(10),
        'updated_at' => $faker->dateTimeBetween($created_at),
        'created_at' => $created_at,
    ];
});

$factory->define(App\Models\Note::class, function (Faker\Generator $faker) {
    $created_at = $faker->dateTimeThisDecade();
    return [
        'user_id' => function () {
            return (new User())->inRandomOrder()->first()->id;
        },
        'note' => $faker->text(400),
        'updated_at' => $faker->dateTimeBetween($created_at),
        'created_at' => $created_at,
    ];
});

$factory->define(App\Models\Tag::class, function (Faker\Generator $faker) {
    $created_at = $faker->dateTimeThisDecade();
    $generated_tag = $faker->unique()->word;
    $running = true;
    while ($running) {
        $exists = (new \App\Models\Tag())->where('tag', $generated_tag)->count('id') > 0;
        if ($exists) {
            $generated_tag = $faker->unique()->word;
        } else {
            $running = false;
        }
    }
    return [
        'user_id' => function () {
            return (new User())->inRandomOrder()->first()->id;
        },
        'tag' => $generated_tag,
        'updated_at' => $faker->dateTimeBetween($created_at),
        'created_at' => $created_at,
    ];
});
