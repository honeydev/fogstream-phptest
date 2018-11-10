<?php

use Faker\Generator as Faker;

$factory->define(\News\News::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'user_id' => factory(News\User::class)->create()->id
    ];
});
