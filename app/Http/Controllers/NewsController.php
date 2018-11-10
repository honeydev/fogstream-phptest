<?php

declare(strict_types=1);

namespace News\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \News\{News, Preview};

class NewsController extends Controller
{
    /**
     * @var \News\Savers\PreviewSaver
     */
    private $previewSaver;

    public function __construct(\News\Savers\PreviewSaver $previewSaver)
    {
        $this->previewSaver = $previewSaver;
    }

    public function index()
    {
        return view('news.frontpage', ['page' => 'Main page']);
    }

    public function addPage()
    {
        return view('news.addnews', ['page' => 'Add news']);
    }

    public function storeNews(Request $request)
    {
        $validatedRequestBody = $request->validate([
            'title' => 'required|between:1,30',
            'body' => 'required|between:1,500',
            'preview' => 'image|max:3000'
        ]);
        $owner = Auth::user();
        $newsData = [
            'title' => $validatedRequestBody['title'],
            'body' => $validatedRequestBody['body'],
            'user_id' => $owner->id
        ];
        $news = News::create($newsData);
        if (array_key_exists('preview', $validatedRequestBody)) {
            $this->previewSaver->save($validatedRequestBody['preview'], $news);
        }
        return redirect("/news/{$news->id}");
    }

    public function newsPage(Request $request, string $id)
    {
        $targetNews = News::find(($id));
        if (empty($targetNews)) {
           return redirect('/404');
        }
        $author = $targetNews->author();
        $preview = $targetNews->preview();
        return view('news.news', [
            'page' => "News {$targetNews->title}",
            'news' => $targetNews,
            'author' => $author,
            'preview' => $preview
        ]);
    }

    public function getAllNews()
    {
        
    }
}
