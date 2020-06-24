<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\CellGroup;
use App\User;
use Faker\Generator as Faker;

$factory->define(CellGroup::class, function (Faker $faker) {
    return [
        //
        'user_id' => factory(User::class),

        
    ];
});
