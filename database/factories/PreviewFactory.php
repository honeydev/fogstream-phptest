<?php

use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;

$factory->define(\News\Preview::class, function (Faker $faker) {
    Storage::fake('previews');
    $file = UploadedFile::fake()->image('preview.jpg');
    return [
        'name' => $file->name,
        'news_id' => factory(\News\User::class)
    ];
});
