<?php

use Laravel\Telescope\Telescope;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Landing\CHome;
use App\Http\Controllers\Landing\CNews;
use App\Http\Controllers\Landing\CPage;




Route::middleware(['logVisitor'])->group(function () {
    Route::get('/', [CHome::class, 'index'])->name('home');
    Route::get('/lecturers-and-educators', [CPage::class, 'lecturers'])->name('home.page.lecturers');
    Route::get('/publications', [CPage::class, 'publications'])->name('home.page.publications');
    Route::prefix('/news')->name("home.news.")->controller(CNews::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{news}', 'detail')->name('detail');
    });
    Route::name("home.page.")->controller(CPage::class)->group(function () {
        Route::get('/{slug}', 'index')
            ->where('slug', '[a-zA-Z0-9-_]+')
            ->name('index');
    });
});
