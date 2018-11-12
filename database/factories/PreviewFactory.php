<?php

use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;

$factory->define(\News\Preview::class, function (Faker $faker) {
    return [
        'news_id' => factory(\News\User::class)
    ];
});
