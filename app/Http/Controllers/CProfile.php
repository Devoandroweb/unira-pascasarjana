<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ResponseOutput;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Other\ProfileRequest;
use App\Repositories\App\AppRepository;

class CProfile extends Controller
{
    use ResponseOutput;
    protected $appRepository;
    public function __construct(AppRepository $appRepository) {
        $this->appRepository = $appRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = __("Profile");
        return view('pages.dashboard.profile.index', compact('title'));
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
    public function store(ProfileRequest $request)
    {
        return $this->safeApiCall(function() use($request){
            $data = $request->validated();
            $model = User::find(Auth::user()->id);
            $this->appRepository->updateOneModelWithFile($model, $data, 'photo', 'image/users');
            return $this->responseSuccess(['message' =>  __("Profile Updated Successfully")]);
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
    public function edit(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
