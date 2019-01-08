<?php

//use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Member::class, function () {
    $faker = Faker\Factory::create('zh_CN');
    return [
        'name' => $faker->name,
        'number' => str_pad(mt_rand(0, 999999), 8, "0", STR_PAD_BOTH),
        'id_card' => str_pad(mt_rand(0, 999999999999999999), 18, "0", STR_PAD_BOTH)
    ];
});
