<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\traits\CreateNewsTrait;
use \News\{User, News};

class NewsTest extends TestCase
{
    use DatabaseMigrations;
    use CreateNewsTrait;

    public function testGetSelectFirstTenNews()
    {
        parent::setUp();
        $news = $this->createNews(20);
        $cursor = 1;
        $response = $this->get("/api/news/get?page={$cursor}");
        $transformedNews = $this->transformNews($news);
        for ($i = 0; $i < 9; $i++) {
            $response->assertSee(json_encode($transformedNews[$i]));
        }
    }

    public function testGetSecondTenNews()
    {
        $news = $this->createNews(20);
        $cursor = 2;
        $response = $this->get("/api/news/get?page={$cursor}");
        $transformedNews = $this->transformNews($news);
        for ($i = 10; $i < 19; $i++) {
            $response->assertSee(json_encode($transformedNews[$i]));
        }
    }

    public function testGetAllNews()
    {
        parent::setUp();
        $news = $this->createNews(5);
        $response = $this->get('/api/news/get/all');
        $response->assertStatus(200);
        $transformedNews = $this->transformNews($news);
        $transformedNews = array_reverse($transformedNews);
        foreach ($transformedNews as $singleNews) {
            $response->assertSee(json_encode($singleNews));
        }
    }

    public function testUserCanCreateNews(): void
    {
        parent::setUp();
        $user = factory('News\User')->create();
        $this->be($user);
        $news = factory(News::class)->create(['user_id' => $user->id]);
        $this->post("/news/store", $news->toArray());
        $response = $this->get("/news/{$news->id}");
        $response->assertSee($news->title);
    }

    private function transformNews(array $news): array
    {
        $transformedNews = [];
        for ($i = 0; $i < count($news); $i++) {
            $preview = $news[$i]->preview();
            $author = $news[$i]->author();
            $newsArray = [
                'id' => $news[$i]->id,
                'title' => $news[$i]->title,
                'body' => $news[$i]->body,
                'url' => $news[$i]->getUrl(),
                'created' => $news[$i]->created_at,
                'author' => [
                    'email' => $author->email,
                    'name' => $author->name,
                    'id' => $author->id
                ]
            ];
            if (!empty($preview)) {
                $newsArray['preview'] = [
                    'name' => $preview->name,
                    'url' => $preview->getUrl(),
                    'news_id' => $preview->news_id
                ];
            }
            $transformedNews[] = $newsArray;
        }
        return $transformedNews;
    }
}
