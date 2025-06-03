<?php

namespace App\Http\Controllers\Administrator\Master;

use App\Models\Lecturer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\ResponseOutput;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\LecturerRequest;
use Illuminate\Routing\Controllers\Middleware;
use App\Repositories\Lecturer\LecturerRepository;
use Illuminate\Routing\Controllers\HasMiddleware;

class CLecturer extends Controller implements HasMiddleware
{
    use ResponseOutput;
    protected $lecturerRepository;
    public static function middleware(): array
    {
        return [
            new Middleware('roles:admin')
        ];
    }
    public function __construct(LecturerRepository $lecturerRepository)
    {
        $this->lecturerRepository = $lecturerRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = __("Lecturers and Educators");
        return view('pages.dashboard.master.lecturer.index', compact('title'));
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
    public function store(LecturerRequest $request)
    {
        return $this->safeApiCall(function () use ($request) {
            try {
                $data = $request->validated();
                if ($data['id']) {
                    $this->lecturerRepository->updateLecture($data);
                    return $this->responseSuccess(['message' =>  __("Data Updated Successfully")]);
                } else {

                    $this->lecturerRepository->insertLecture($data);
                    return $this->responseSuccess(['message' => __("Data Added Successfully")]);
                }
            } catch (\Exception $e) {
                DB::rollBack();
                return $this->responseFailed($e->getMessage());
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
    public function edit(Lecturer $lecturer)
    {
        return $this->safeApiCall(function () use ($lecturer) {

            return $this->responseSuccess($lecturer->with('user')->first());
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
    public function destroy(Lecturer $lecturer)
    {
        return $this->safeApiCall(function () use ($lecturer) {
            $this->lecturerRepository->deleteLecture($lecturer);
            return $this->responseSuccess(['message' => __("Data Deleted Successfully")]);
        });
    }

    public function trash()
    {
        $title = __("Trash");
        return view('pages.dashboard.master.lecturer.trash', compact('title'));
    }
    public function restore(Request $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $this->lecturerRepository->restore($request);
            return $this->responseSuccess(['message' => __('Data Restored Successfully')]);
        });
    }
    public function delete(Request $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $this->lecturerRepository->forceDelete($request);
            return $this->responseSuccess(['message' => __('Data Deleted Successfully')]);
        });
    }
}
