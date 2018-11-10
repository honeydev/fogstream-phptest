<?php

declare(strict_types=1);

namespace News\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \News\Savers\PreviewSaver;
use \News\Transformers\NewsTransformer;
use \News\{News, Preview};
use League\Fractal\Manager;

class NewsController extends Controller
{
    /**
     * @var \News\Savers\PreviewSaver
     */
    private $previewSaver;

    /**
     * @var \News\Transformers\NewsTransformer
     */
    private $newsTransformer;

    private $fractalManager;

    public function __construct(
        PreviewSaver $previewSaver, 
        NewsTransformer $newsTransformer,
        Manager $fractalManager
    )
    {
        $this->previewSaver = $previewSaver;
        $this->newsTransformer = $newsTransformer;
        $this->fractalManager = $fractalManager;
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

    public function getAll()
    {
        $allNewsResource = $this->newsTransformer->transform(News::all());
        $allNews = $this->fractalManager->createData($allNewsResource);
        dd($allNews->toArray());
        $allNewsCollection = $allNewsResource->getData();
        return response()->json($allNewsCollection);
    }
}
