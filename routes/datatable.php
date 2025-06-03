<?php

use App\Http\Controllers\CDatatable;
use Illuminate\Support\Facades\Route;

Route::prefix('datatable')->name('datatable.')->controller(CDatatable::class)->group(function () {
    Route::get('lecturers', 'lecturers')->name('lecturers');
    Route::get('users', 'users')->name('users');
    Route::get('categories', 'categories')->name('categories');
    Route::get('pages', 'pages')->name('pages');
    Route::get('pages/categories', 'pageCategory')->name('pages.categories');
    Route::get('news', 'news')->name('news');
    Route::get('achievements', 'achievements')->name('achievements');
    Route::get('sliders', 'sliders')->name('sliders');
    Route::get('partners', 'partners')->name('partners');
    Route::get('testimonials', 'testimonials')->name('testimonials');
    Route::get('publications', 'publications')->name('publications');
    Route::get('home/publications', 'publicationLists')->name('home.publications');
});
