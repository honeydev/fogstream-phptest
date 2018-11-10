<?php

declare(strict_types=1);

namespace Tests\traits;

use News\News;

trait CreateNewsTrait
{
    public function createNews(int $count, $attributes = [])
    {
        $news = [];
        for ($i = 0; $i < $count; $i++) {
            $news[] = factory(\News\News::class)->create($attributes);
        }
        return $news;
    }
}
