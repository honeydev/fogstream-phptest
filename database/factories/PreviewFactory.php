<?php

use Faker\Generator as Faker;

$factory->define(\News\Preview::class, function (Faker $faker) {
    return [
        'name' => $faker->image(),
        'news_id' => factory(\News\User::class)
    ];
});
