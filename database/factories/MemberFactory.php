<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Member;
use Faker\Generator as Faker;
use App\User;

$factory->define(Member::class, function (Faker $faker) {
    return [
        //
        'user_id' => factory(User::class),
        'name' => $faker->name,
        'email' => $faker->email,
        'birthday' => '09/24/1989',
        'company' => $faker->company,
        'position' => 'Web Developer',
        'location' => 'Pangasinan',
        'offerings' => '100',


        
    ];
});
