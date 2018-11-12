<?php

use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;

$factory->define(\News\News::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraphs(5, true),
        'user_id' => factory(News\User::class)->create()->id
    ];
});

$factory->afterCreating(\News\News::class, function ($news, Faker $faker) {
    $saver = new \News\Savers\PreviewSaver();
    $file = UploadedFile::fake()->image('preview.jpg', 500, 300);
    if (env('APP_ENV') !== 'testing') {
        $saver->save($file, $news);
    }
    factory(\News\Preview::class)->create(["news_id" => $news->id, "name" => $file->name]);
});
