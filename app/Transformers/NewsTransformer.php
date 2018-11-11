<?php

declare(strict_types=1);

namespace News\Transformers;

use League\Fractal;
use News\News;

class NewsTransformer extends Fractal\TransformerAbstract
{
    public function transform($allNews)
    {
        return new Fractal\Resource\Collection($allNews, function (News $news) {
            $author = $news->author();
            $newsData = [
                 'id' => $news->id,
                 'title' => $news->title,
                 'body' => $news->body,
                 'url' => $news->getUrl(),
                 'created' => $news->created_at,
                 'author' => [
                     'email' => $author->email,
                     'name' => $author->name,
                     'id' => $author->id
                 ]
            ];
            $preview = $news->preview();
            if (!empty($preview)) {
                $newsData['preview'] = [
                    'name' => $preview->name,
                    'url' => $preview->getUrl(),
                    'news_id' => $preview->news_id
                ];
            }
            return $newsData;
        });
    }

    private function preparePreview($preview)
    {

    }
}
