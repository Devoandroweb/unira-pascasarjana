<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Traits\ResponseOutput;
use App\Http\Controllers\Controller;
use App\Http\Requests\Other\PublicationRequest;
use App\Models\Publication;
use App\Repositories\App\AppRepository;
use Illuminate\Routing\Controllers\Middleware;

class CPublication extends Controller
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
        $title = __("Publications");
        return view('pages.dashboard.publication.index', compact('title'));
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
    public function store(PublicationRequest $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $data = $request->validated();
            $model = new Publication();
            $path ='images/ejournal';
            if ($data['id']) {
                $this->appRepository->updateOneModelWithFile($model, $data, 'cover', $path);
                return $this->responseSuccess(['message' =>  __("Data Updated Successfully")]);
            } else {
                $this->appRepository->insertOneModelWithFile($model, $data, 'cover', $path);
                return $this->responseSuccess(['message' => __("Data Added Successfully")]);
            }
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
    public function edit(Publication $publication)
    {
        return $this->safeApiCall(function() use($publication){
            return $this->responseSuccess($publication);
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
    public function destroy(Publication $publication)
    {
        return $this->safeApiCall(function () use ($publication) {
            $this->appRepository->deleteOneModel($publication);
            return $this->responseSuccess(['message' => __('Data Deleted Successfully')]);
        });
    }

    public function trash()
    {
        $title = __("Trash");
        return view('pages.dashboard.publication.trash', compact('title'));
    }
    public function restore(Request $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $model = Publication::whereIn('id', explode(',', $request->id))->onlyTrashed();;
            $this->appRepository->restore($model);
            return $this->responseSuccess(['message' => __('Data Restored Successfully')]);
        });
    }
    public function delete(Request $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $model = Publication::whereIn('id', explode(',', $request->id))->onlyTrashed();
            $this->appRepository->forceDeleteOneModel($model);
            return $this->responseSuccess(['message' => __('Data Deleted Successfully')]);
        });
    }
}
