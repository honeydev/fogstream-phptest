<?php

use Faker\Generator as Faker;

$factory->define(\News\News::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'user_id' => factory(News\User::class)->create()->id
    ];
});

$factory->afterCreating(\News\News::class, function ($news, Faker $faker) {
    factory(\News\Preview::class)->create(["news_id" => $news->id]);
});
