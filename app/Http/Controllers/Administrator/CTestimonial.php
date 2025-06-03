<?php

namespace App\Http\Controllers\Administrator;

use App\Http\Controllers\Controller;
use App\Http\Requests\Other\TestimonialRequest;
use App\Models\Testimonial;
use App\Repositories\App\AppRepository;
use App\Traits\ResponseOutput;
use Illuminate\Http\Request;

class CTestimonial extends Controller
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
        $title = __("Testimonials");
        return view('pages.dashboard.testimonial.index', compact('title'));
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
    public function store(TestimonialRequest $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $data = $request->validated();
            if ($data['id']) {
                $model = Testimonial::find($data['id']);
                $this->appRepository->updateOneModelWithFile($model, $data, 'photo','images/testimonials');
                return $this->responseSuccess(['message' =>  __("Data Updated Successfully")]);
            }else{
                $model = new Testimonial();
                $this->appRepository->insertOneModelWithFile($model, $data, 'photo', 'images/testimonials');
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
    public function edit(Testimonial $testimonial)
    {
        return $this->safeApiCall(function() use ($testimonial){
            return $this->responseSuccess($testimonial);
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
    public function destroy(Testimonial $testimonial)
    {
        return $this->safeApiCall(function() use ($testimonial){
            $this->appRepository->deleteOneModel($testimonial);
            return $this->responseSuccess(['message' => __('Data Deleted Successfully')]);
        });
    }

    public function trash()
    {
        $title = __("Trash");
        return view('pages.dashboard.testimonial.trash', compact('title'));
    }
    public function restore(Request $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $model = Testimonial::whereIn('id', explode(',', $request->id))->onlyTrashed();
            $this->appRepository->restore($model);
            return $this->responseSuccess(['message' => __('Data Restored Successfully')]);
        });
    }
    public function delete(Request $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $model = Testimonial::whereIn('id', explode(',', $request->id))->onlyTrashed();
            $this->appRepository->forceDeleteOneModelWithFile($model,'photo');
            return $this->responseSuccess(['message' => __('Data Deleted Successfully')]);
        });
    }
}
