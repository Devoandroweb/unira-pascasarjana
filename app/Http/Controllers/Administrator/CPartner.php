<?php

namespace App\Http\Controllers\Administrator;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Traits\ResponseOutput;
use App\Http\Controllers\Controller;
use App\Http\Requests\Other\PartnerRequest;
use App\Repositories\App\AppRepository;

class CPartner extends Controller
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
        $title = __("Partners");
        return view('pages.dashboard.partner.index', compact('title'));
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
    public function store(PartnerRequest $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $data = $request->validated();
            if ($data['id']) {
                $model = Partner::find($data['id']);
                $this->appRepository->updateOneModelWithFile($model, $data, 'logo', 'images/partner');
                return $this->responseSuccess(['message' =>  __("Data Updated Successfully")]);
            } else {
                $model = new Partner();
                $this->appRepository->insertOneModelWithFile($model, $data, 'logo', 'images/partner');
                return $this->responseSuccess(['message' => __("Data Added Successfully")]);
            }
        });
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        return $this->safeApiCall(function () use ($partner) {
            return $this->responseSuccess($partner);
        });
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        return $this->safeApiCall(function () use ($partner) {
            $this->appRepository->deleteOneModel($partner);
            return $this->responseSuccess(['message' => __('Data Deleted Successfully')]);
        });
    }

    public function trash()
    {
        $title = __("Trash");
        return view('pages.dashboard.partner.trash', compact('title'));
    }
    public function restore(Request $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $model = Partner::whereIn('id', explode(',', $request->id))->onlyTrashed();
            $this->appRepository->restore($model);
            return $this->responseSuccess(['message' => __('Data Restored Successfully')]);
        });
    }
    public function delete(Request $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $model = Partner::whereIn('id', explode(',', $request->id))->onlyTrashed();
            $this->appRepository->forceDeleteOneModelWithFile($model,'logo');
            return $this->responseSuccess(['message' => __('Data Deleted Successfully')]);
        });
    }
}
