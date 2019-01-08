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
        'number' => mt_rand(pow(10, 8 - 1), pow(10, 8) - 1),
        'id_card' => mt_rand(pow(10, 18 - 1), pow(10, 18) - 1)
    ];
});
