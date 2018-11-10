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

    public function testGetAllNews()
    {
        parent::setUp();
        $news = $this->createNews(30);
        $response = $this->get('/api/get/news/all');
        $response->assertStatus(200)
            ->assertJson($news->toArray());
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
}
