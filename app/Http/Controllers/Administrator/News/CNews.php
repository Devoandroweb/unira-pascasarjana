<?php

namespace App\Http\Controllers\Administrator\News;

use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Traits\ResponseOutput;
use App\Http\Controllers\Controller;
use App\Http\Requests\News\NewsRequest;
use App\Repositories\App\AppRepository;

class CNews extends Controller
{
    use ResponseOutput;
    protected $appRepository;
    public function __construct(AppRepository $appRepository)
    {
        $this->appRepository = $appRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = __("News");
        return view("pages.dashboard.news.index", compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = __("Create News");
        $category = Category::all();
        $route = route('dashboard.news.store');
        return view("pages.dashboard.news.form", compact('title', 'category', 'route'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(NewsRequest $request)
    {

        return $this->safeApiCall(function () use ($request) {
            $data = $request->validated();
            $data['category_id'] = $data['category_id'] ?? 0;
            $model = new News();
            $this->appRepository->insertOneModelWithFile($model, $data, 'image', 'images/news');
            return $this->responseSuccess(['message' => __("News Created Successfully"), 'route' => route('dashboard.news.index')]);
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        $title = __("Create News");
        $category = Category::all();
        $route = route('dashboard.news.update', $news->slug);
        return view("pages.dashboard.news.form", compact('title', 'category', 'route', 'news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(NewsRequest $request,News $news)
    {
        return $this->safeApiCall(function () use ($request, $news) {
            $data = $request->validated();
            $data['category_id'] = $data['category_id'] ?? 0;
            $this->appRepository->updateOneModelWithFile($news, $data, 'image', 'images/news');
            return $this->responseSuccess(['message' => __("News Updated Successfully"), 'route' => route('dashboard.news.index')]);
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        return $this->safeApiCall(function () use ($news) {
            $this->appRepository->deleteOneModel($news);
            return $this->responseSuccess(['message' => __('News Successfully Deleted')]);
        });
    }

    public function trash()
    {
        $title = __("Trash");
        return view('pages.dashboard.news.trash', compact('title'));
    }
    public function restore(Request $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $model = News::whereIn('id', explode(',', $request->id))->onlyTrashed();
            $this->appRepository->restore($model);
            return $this->responseSuccess(['message' => __('News Restored Successfully')]);
        });
    }
    public function delete(Request $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $model = News::whereIn('id', explode(',', $request->id))->onlyTrashed();
            $this->appRepository->forceDeleteOneModelWithFile($model,'image');
            return $this->responseSuccess(['message' => __('News Successfully Deleted')]);
        });
    }
}
