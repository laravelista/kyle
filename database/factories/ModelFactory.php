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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'api_token' => bin2hex(openssl_random_pseudo_bytes(16)),
        'email_notifications' => false, //$faker->boolean
        'preferred_currency' => $faker->randomElement(['hrk', 'usd', 'eur'])
    ];
});

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->randomElement(['Hosting', 'Maintenance', 'Domain', 'SSL Certificate']),
    ];
});

$factory->define(App\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'tax_number' => $faker->randomNumber,
        'street' => $faker->streetAddress,
        'city' => $faker->city,
        'postal_code' => $faker->postcode
    ];
});

$factory->define(App\Service::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(3),
        'note' => $faker->text(200),
        'month' => (int) $faker->month,
        'day' => (int) $faker->dayOfMonth,
        'cost' => $faker->randomNumber(5),
        'currency' => $faker->randomElement(['hrk', 'eur', 'usd']),
        'active' => $faker->boolean,
        'exchange_rate' => $faker->randomFloat(4, 1, 11),
        'client_id' => factory(App\Client::class)->create()->id,
        'category_id' => factory(App\Category::class)->create()->id,
    ];
});

$factory->define(App\Occurrence::class, function (Faker\Generator $faker) {
    return [
        'occurs_at' => $faker->dateTimeThisYear,
        'offer_sent' => $faker->boolean,
        'payment_received' => $faker->boolean,
        'receipt_sent' => $faker->boolean,
        'service_id' => factory(App\Service::class)->create()->id
    ];
});
