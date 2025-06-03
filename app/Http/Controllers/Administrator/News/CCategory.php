<?php

namespace App\Http\Controllers\Administrator\News;

use Illuminate\Http\Request;
use App\Traits\ResponseOutput;
use App\Http\Controllers\Controller;
use App\Http\Requests\News\CategoryRequest;
use App\Models\Category;
use App\Repositories\App\AppRepository;
use Illuminate\Routing\Controllers\Middleware;

class CCategory extends Controller
{
    use ResponseOutput;
    protected $appRepository;
    public static function middleware(): array
    {
        return [
            new Middleware('roles:admin')
        ];
    }
    public function __construct(AppRepository $appRepository)
    {
        $this->appRepository = $appRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = __("Categories");
        return view('pages.dashboard.category.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $model = new Category;
        if ($data['id']) {

            $this->appRepository->updateOneModel($model,$data);
            return $this->responseSuccess(['message' =>  __("Data Updated Successfully")]);
        } else {

            $this->appRepository->insertOneModel($model, $data);
            return $this->responseSuccess(['message' => __("Data Added Successfully")]);
        }
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
    public function edit(Category $category)
    {
        return $this->safeApiCall(function () use ($category) {
            return $this->responseSuccess($category);
        });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        return $this->safeApiCall(function () use ($category) {
            $this->appRepository->deleteOneModel($category);
            return $this->responseSuccess(['message' => __('Data Deleted Successfully')]);
        });
    }

    public function trash()
    {
        $title = __("Trash");
        return view('pages.dashboard.category.trash', compact('title'));
    }
    public function restore(Request $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $model = Category::whereIn('id', explode(',', $request->id))->onlyTrashed();;
            $this->appRepository->restore($model);
            return $this->responseSuccess(['message' => __('Data Restored Successfully')]);
        });
    }
    public function delete(Request $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $model = Category::whereIn('id', explode(',', $request->id))->onlyTrashed();
            $this->appRepository->forceDeleteOneModel($model);
            return $this->responseSuccess(['message' => __('Data Deleted Successfully')]);
        });
    }
}
