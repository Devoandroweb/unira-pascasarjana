<?php

namespace App\Http\Controllers\Administrator\Master;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\ResponseOutput;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\UserRequest;
use App\Repositories\App\AppRepository;
use App\Repositories\Auth\AuthRepository;
use Illuminate\Routing\Controllers\Middleware;

class CUser extends Controller
{
    use ResponseOutput;
    protected $appRepository, $authRepository;
    public static function middleware(): array
    {
        return [
            new Middleware('roles:admin')
        ];
    }
    public function __construct(AppRepository $appRepository, AuthRepository $authRepository)
    {
        $this->appRepository = $appRepository;
        $this->authRepository = $authRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = __("Users");
        return view('pages.dashboard.master.user.index', compact('title'));
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
    public function store(UserRequest $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $data = $request->validated();
            if ($data['id']) {
                $model = User::find($data['id']);

                $this->appRepository->updateOneModelWithFile($model, $data, 'photo', 'image/users');
                return $this->responseSuccess(['message' =>  __("Data Updated Successfully")]);
            } else {

                $this->authRepository->register($data);
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
    public function edit(User $user)
    {
        return $this->safeApiCall(function () use ($user) {
            return $this->responseSuccess($user);
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
    public function destroy(User $user)
    {
        return $this->safeApiCall(function () use ($user) {
            $this->appRepository->deleteOneModel($user);
            return $this->responseSuccess(['message' => __('Data Deleted Successfully')]);
        });
    }

    public function trash()
    {
        $title = __("Trash");
        return view('pages.dashboard.master.user.trash', compact('title'));
    }

    public function restore(Request $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $model = User::whereIn('id', explode(',', $request->id))->onlyTrashed();;
            $this->appRepository->restore($model);
            return $this->responseSuccess(['message' => __('Data Restored Successfully')]);
        });
    }
    public function delete(Request $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $model = User::whereIn('id', explode(',', $request->id))->onlyTrashed();
            $this->appRepository->forceDeleteOneModelWithFile($model,'photo');
            return $this->responseSuccess(['message' => __('Data Deleted Successfully')]);
        });
    }
}
