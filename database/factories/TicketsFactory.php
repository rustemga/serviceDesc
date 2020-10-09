<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tickets;
use Faker\Generator as Faker;

$factory->define(Tickets::class, function (Faker $faker) {
    return [
        'user_id'=>factory(\App\User::class),
        'subject'=>$faker->sentence,
        'status'=>'open',
        'ticket_text'=>$faker->paragraph,
    ];
});
