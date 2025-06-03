<?php

namespace App\Repositories\Lecturer;

use App\Models\User;
use App\Models\Lecturer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Repositories\Auth\AuthRepository;
use LaravelEasyRepository\Implementations\Eloquent;

class LecturerRepositoryImplement extends Eloquent implements LecturerRepository
{

    /**
     * Model class to be used in this repository for the common methods inside Eloquent
     * Don't remove or change $this->model variable name
     * @property Model|mixed $model;
     */
    protected $model, $authRepository;

    public function __construct(Lecturer $model, AuthRepository $authRepository)
    {
        $this->model = $model;
        $this->authRepository = $authRepository;
    }

    public function insertLecture($data)
    {
        return DB::transaction(function () use ($data) {

            if (request()->filled('register')) {
                $user =  $this->authRepository->register($data);
                // dd($user);
            }
            // dd($user);
            $lecturerData = [
                // Add other lecturer fields as needed
                'name' => $data['name'],
                'position' => $data['position'],
                'gender' => $data['gender'],
                'phone' => $data['phone'],
                'user_id' => request()->filled('register') ? $user->id : 0,
                'is_user' => request()->filled('register') ? 1 : 0,
                'facebook' => $data['facebook'] ?? null,
                'instagram' => $data['instagram'] ?? null,
                'google_scholar' => $data['google_scholar'] ?? null,
                'sinta' => $data['sinta'] ?? null,
                'journal' => $data['journal'] ?? null,
            ];
            if (request()->hasFile('photo')) {
                $fileKey = 'photo';
                $filePath = 'images/lecture';
                $lecturerData['photo'] = request()->file($fileKey)->store($filePath, 'public');
            }
            $lecture = $this->model->create($lecturerData);

            return $lecture;
        });
    }
    public function updateLecture($data)
    {
        return DB::transaction(function () use ($data) {
            $lecture = $this->model->find($data['id']);
            if (request()->filled('register')) {
                $user =  $this->authRepository->register($data);
            } else {
                $user = User::find($lecture->user_id);
                if ($user && $user->photo) {
                    Storage::disk('public')->delete($user->photo);
                }
                if ($user) {

                    $user->delete();
                }
            }
            $lecturerData = [
                // Add other lecturer fields as needed
                'name' => $data['name'],
                'position' => $data['position'],
                'gender' => $data['gender'],
                'phone' => $data['phone'],
                'user_id' => request()->filled('register') ? $user->id : 0,
                'is_user' => request()->filled('register') ? 1 : 0,
                'facebook' => $data['facebook'] ?? null,
                'instagram' => $data['instagram'] ?? null,
                'google_schoolar' => $data['google_schoolar'] ?? null,
                'sinta' => $data['sinta'] ?? null,
                'journal' => $data['journal'] ?? null,
            ];
            if (request()->hasFile('photo')) {
                if ($lecture->photo) {
                    Storage::disk('public')->delete($lecture->photo);
                }
                $fileKey = 'photo';
                $filePath = 'images/lecture';
                $lecturerData['photo'] = request()->file($fileKey)->store($filePath, 'public');
            }
            $lecture->update($lecturerData);

            return $user;
        });
    }

    public function deleteLecture($lecture)
    {

        $lecture?->user()->delete();
        $lecture->delete();
    }

    public function restore($request)
    {
        $ids = explode(',', $request->id);
        $this->model->onlyTrashed()->whereIn('id', $ids)->restore();
        User::onlyTrashed()
            ->whereIn('id', function ($query) use ($ids) {
                $query->select('user_id')
                    ->from('lecturers')
                    ->whereIn('id', $ids)
                    ->whereNotNull('user_id');
            })
            ->restore();
    }

    public function forceDelete($request)
    {
        $ids = explode(',', $request->id);
        $lecturers = $this->model->onlyTrashed()
            ->whereIn('id', $ids)
            ->with(['user' => function ($query) {
                $query->withTrashed();
            }])
            ->get();
        $lecturers->each(function ($lecture) {
            if ($lecture->user?->profile_picture) {
                Storage::disk('public')->delete($lecture?->user?->profile_picture);
            }
            $lecture?->user()?->forceDelete();
            if ($lecture->photo) {
                Storage::disk('public')->delete($lecture?->photo);
            }
        });

        $this->model->onlyTrashed()
            ->whereIn('id', $ids)
            ->forceDelete();
    }
}
