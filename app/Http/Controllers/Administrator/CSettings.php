<?php

namespace App\Http\Controllers\Administrator;

use Illuminate\Http\Request;
use App\Traits\ResponseOutput;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingsRequest;
use Illuminate\Support\Facades\Storage;

class CSettings extends Controller
{
    use ResponseOutput;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = __("Settings");
        return view('pages.dashboard.settings.index', compact('title'));
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
    public function store(SettingsRequest $request)
    {
        return $this->safeApiCall(function () use ($request) {
            $data = $request->validated();
            $fieldsToUpdate = ['website_logo', 'favicon','greeting_photo'];
            foreach ($fieldsToUpdate as $field) {
                if ($request->hasFile($field) && isset($data[$field])) {
                    $oldFile = settings()->get($field);
                    if ($oldFile) {
                        Storage::disk('public')->delete($oldFile);
                    }
                    $data[$field] = $request->file($field)->store("images/logo", 'public');
                }
            }
            settings()->set($data);
            return $this->responseSuccess(['message' => __("Settings Updated Successfully"), 'settings' => settings()->all()]);
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
