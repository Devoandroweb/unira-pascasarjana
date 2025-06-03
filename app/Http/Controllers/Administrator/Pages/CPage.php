<?php

namespace App\Http\Controllers\Administrator\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\Page\PageRequest;
use App\Models\CategoriesPage;
use App\Models\Page;
use App\Models\PageCategory;
use App\Models\PageFile;
use App\Repositories\App\AppRepository;
use App\Traits\ResponseOutput;
use DragonCode\Support\Facades\Filesystem\File;
use Illuminate\Http\Request;

class CPage extends Controller
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
        $title = __("Pages");
        $data = Page::orderBy("title")->get();
        return view('pages.dashboard.page.index', compact('data', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = __("Create Pages");
        $route = route('dashboard.pages.store');
        $pageCategory = PageCategory::orderBy("categories_name")->get();
        $page = null;
        $files = [];
        return view("pages.dashboard.page.form", compact('title', 'route', 'page', 'files', 'pageCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PageRequest $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $data = $request->validated();
            $data["table"] = $data["table"] ?? null;
            if ($request->hasFile("image")) {

                $file = $request->file("image");
                $fileName = $file->store('images/pages/', 'public');
                $data["image"] = $fileName;
            }
            $page = $this->appRepository->insertOneModelWithFile(new Page, $data, 'image', 'images/pages');
            if (isset($data["files"])) {
                if (count($data["files"]) > 0) {

                    for ($i = 0; $i < count($data["files"]); $i++) {
                        $dataPageFile["page_id"] = $page->id;
                        $dataPageFile["size"] = $request->file('files.' . $i)->getSize();
                        $dataPageFile["file_name"] = $data["file_name"][$i];
                        $pageFile = new PageFile();
                        $this->appRepository->insertOneModelWithFileArray($pageFile, $dataPageFile, "path_file", 'files.' . $i, 'files/pages');
                    }
                }
            }

            $route = route('dashboard.pages.index');
            $type =  $page->type;
            return $this->responseSuccess(['message' => __("Data Added Successfully"), 'route' => $route, 'type' => $type]);
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
    public function edit(Page $page)
    {
        $title = $page->title;
        $files = $page->files;
        $pageCategory = PageCategory::orderBy("categories_name")->get();
        $route = route('dashboard.pages.update', $page->slug);
        return view("pages.dashboard.page.form", compact('title', 'route', 'page', 'files', 'pageCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PageRequest $request, Page $page)
    {
        return $this->safeApiCall(function () use ($request, $page) {
            $data = $request->validated();
            $data["table"] = $data["table"] ?? null;
            $data["slug"] = str()->slug($data["title"]);
            $filesPage = PageFile::wherePageId($page->id);
            foreach ($filesPage->get() as $pf) {
                if (File::exists(storage_path("app/public/$pf->path_file"))) {
                    File::delete(storage_path("app/public/$pf->path_file"));
                }
            }
            $filesPage->delete();

            if (isset($data["files"])) {
                if (count($data["files"]) > 0) {

                    for ($i = 0; $i < count($data["files"]); $i++) {
                        $dataPageFile["page_id"] = $page->id;
                        $dataPageFile["size"] = $request->file('files.' . $i)->getSize();
                        $dataPageFile["file_name"] = $data["file_name"][$i];
                        $pageFile = new PageFile();
                        $this->appRepository->insertOneModelWithFileArray($pageFile, $dataPageFile, "path_file", 'files.' . $i, 'files/pages');
                    }
                }
            }
            if ($request->hasFile("image")) {
                $pathExist = "images/pages/" . $page->cover_image;
                if (File::exists($pathExist)) {
                    File::delete($pathExist);
                }
                $file = $request->file("image");
                $fileName = $file->store('images/pages', 'public');
                $data["cover_image"] = $fileName;
            }
            $this->appRepository->updateOneModelWithFile($page, $data, 'image', 'images/pages');
            $route = route('dashboard.pages.index');
            $type = $page->type;
            return $this->responseSuccess(['message' => __("Data Updated Successfully"), 'route' => $route, 'type' => $type]);
        });
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trash()
    {
        $title = __("Trash");
        return view('pages.dashboard.page.trash', compact('title'));
    }
    public function restore(Request $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $model = Page::whereIn('id', explode(',', $request->id))->onlyTrashed();
            $this->appRepository->restore($model);
            return $this->responseSuccess(['message' => __('Data Restored Successfully')]);
        });
    }
    public function destroy(Page $page)
    {
        return $this->safeApiCall(function () use ($page) {
            $page->delete();
            return $this->responseSuccess(['message' => __("Data Deleted Successfully")]);
        });
    }

    public function delete(Request $request)
    {
   
        return $this->safeApiCall(function () use ($request) {
            $model = Page::whereIn('id', explode(',', $request->id))->onlyTrashed();

            $this->appRepository->forceDeleteOneModelWithFile($model, 'logo');
            return $this->responseSuccess(['message' => __('Data Deleted Successfully')]);
        });
    }
}
