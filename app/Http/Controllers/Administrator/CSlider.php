<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Traits\ResponseOutput;
use App\Http\Controllers\Controller;
use App\Repositories\App\AppRepository;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Other\SliderRequest;
use Illuminate\Routing\Controllers\Middleware;

class CSlider extends Controller
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
        $title = __("Slider");
        return view('pages.dashboard.slider.index', compact('title'));
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
    public function store(SliderRequest $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $data = $request->validated();
            if ($data['id']) {
                $model = Slider::find($data['id']);
                $path = $data['type'] == 'image' ? 'images/slider' : 'video/slider';
                $this->appRepository->updateOneModelWithFile($model, $data, 'file', $path);
                return $this->responseSuccess(['message' =>  __("Data Updated Successfully")]);
            } else {
                $model = new Slider();
                $path = $data['type'] == 'image' ? 'images/slider' : 'video/slider';
                $this->appRepository->insertOneModelWithFile($model, $data, 'file', $path);
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
    public function edit(Slider $slider)
    {
        return $this->safeApiCall(function () use ($slider) {
            return $this->responseSuccess(['slider' => $slider, 'file_url' => Storage::url($slider->file)]);
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
    public function destroy(Slider $slider)
    {
        return $this->safeApiCall(function() use ($slider){
            $this->appRepository->deleteOneModel($slider);
            return $this->responseSuccess(['message' => __('Data Deleted Successfully')]);
        });
    }

    public function trash()
    {
        $title = __("Trash");
        return view('pages.dashboard.slider.trash', compact('title'));
    }
    public function restore(Request $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $model = Slider::whereIn('id', explode(',', $request->id))->onlyTrashed();
            $this->appRepository->restore($model);
            return $this->responseSuccess(['message' => __('Data Restored Successfully')]);
        });
    }
    public function delete(Request $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $model = Slider::whereIn('id', explode(',', $request->id))->onlyTrashed();
            $this->appRepository->forceDeleteOneModelWithFile($model,'file');
            return $this->responseSuccess(['message' => __('Data Deleted Successfully')]);
        });
    }
}
