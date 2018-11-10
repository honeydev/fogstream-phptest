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
            $preview = $news->preview();
            $author = $news->author();
            return [
                // 'id' => $news->id,
                // 'title' => $news->title,
                // 'body' => $news->body,
                // 'created' => $news->created_at,
                // 'preview' => [
                //     'name' => $preview->name,
                //     'url' => $preview->getUrl()
                // ],
                // 'author' => [
                //     'email' => $author->email,
                //     'name' => $author->name,
                //     'id' => $author->id
                // ]
            ];
        });
    }
}
