<?php

declare(strict_types=1);

namespace Tests\traits;

use News\News;

trait CreateNewsTrait
{
    /**
     * @param int $count
     * @param array $attributes
     * @return array
     */
    public function createNews(int $count, array $attributes = []): array
    {
        $news = [];
        for ($i = 0; $i < $count; $i++) {
            $news[] = factory(\News\News::class)->create($attributes);
        }
        return $news;
    }
}
