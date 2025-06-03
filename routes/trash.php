<?php

use App\Http\Controllers\CTrash;
use Illuminate\Support\Facades\Route;

Route::prefix('trash')->name('trash.')->middleware('auth', 'verified')
    ->controller(CTrash::class)
    ->group(function () {
        Route::get('lecturers', 'lecturers')->name('lecturers');
        Route::get('users', 'users')->name('users');
        Route::get('categories', 'categories')->name('categories');
        Route::get('pages', 'pages')->name('pages');
        Route::get('pages/category', 'pageCategory')->name('pages.category');
        Route::get('news', 'news')->name('news');
        Route::get('achievements', 'achievements')->name('achievements');
        Route::get('sliders', 'sliders')->name('sliders');
        Route::get('partners', 'partners')->name('partners');
        Route::get('testimonials', 'testimonials')->name('testimonials');
        Route::get('publications', 'publications')->name('publications');
    });
