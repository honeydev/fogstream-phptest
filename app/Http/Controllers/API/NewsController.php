<?php

namespace News\Http\Controllers\API;

use Illuminate\Http\Request;
use Validator;
use News\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use \News\Savers\PreviewSaver;
use \News\Transformers\NewsTransformer;
use \News\{News, Preview};
use League\Fractal\Manager;
use \News\Helpers\MergePaginationHelper;


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
    /**
     * @var Manager
     */
    private $fractalManager;

    /**
     * NewsController constructor.
     * @param PreviewSaver $previewSaver
     * @param NewsTransformer $newsTransformer
     * @param Manager $fractalManager
     */
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

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAll()
    {
        $allNewsResource = $this->newsTransformer->transform(News::orderBy('created_at', 'desc')->get());
        $allNews = $this->fractalManager->createData($allNewsResource);
        $allNews = $allNews->toArray()['data'];
        return response()->json($allNews);
    }
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByCursor()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(10);
        $newsResource =  $this->newsTransformer->transform($news);
        $newsCollection = $this->fractalManager->createData($newsResource);
        $mergedNews = MergePaginationHelper::merge($news, $newsCollection->toArray());
        return response()->json($mergedNews);
    }


    public function createNews(Request $request)
    {
        $rules = [
            'title' => 'required|between:1,30',
            'body' => 'required|between:1,500',
            'preview' => 'image|max:3000'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()], 400);
        }
        $owner = $request->user();
        $newsData = [
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => $owner->id
        ];
        $news = News::create($newsData);
        if ($request->has('preview')) {
            $this->previewSaver->save($request->preview, $news);
        }
        return response()->json(["success" => "News successful created"], 201);
    }
}
