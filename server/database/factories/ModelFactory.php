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

/** @var \Illuminate\Database\Eloq
 * uent\Factory $factory */
$factory->define(App\Model\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Model\Tieba::class, function (Faker\Generator $faker) {
    return [
        'kw' => $faker->word,
        'fid' => $faker->numberBetween(1223, 45666),
        'sign_at' => $faker->dayOfMonth,
        'sign_infos' => $faker->randomDigitNotNull
    ];
});

$factory->define(App\Model\Role::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->randomKey(["admin", "user", "client", "manager"]),
    ];
});
