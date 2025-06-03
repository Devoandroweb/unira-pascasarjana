<?php

use App\Http\Controllers\CProfile;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\CDashboard;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CLocalization;
use App\Http\Controllers\UpdaterController;
use App\Http\Controllers\Administrator\CMenu;
use App\Http\Controllers\Administrator\CSlider;
use App\Http\Controllers\Administrator\CPartner;
use App\Http\Controllers\Administrator\CSettings;
use App\Http\Controllers\Administrator\News\CNews;
use App\Http\Controllers\Administrator\Pages\CPage;
use App\Http\Controllers\Administrator\CPublication;
use App\Http\Controllers\Administrator\CTestimonial;
use App\Http\Controllers\Administrator\Master\CUser;
use App\Http\Controllers\Administrator\News\CCategory;
use App\Http\Controllers\Administrator\Master\CLecturer;
use App\Http\Controllers\Administrator\Pages\CPageCategory;
use App\Http\Controllers\Administrator\Academic\CAchievement;

// Dashboard
Route::get('/dashboard', [CDashboard::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
// Master Data
Route::middleware(['auth', 'verified', 'can:admin'])->prefix('dashboard/master-data')->name('dashboard.master-data.')->group(function () {
    // Lecturers
    Route::get('lecturers/trash', [CLecturer::class, 'trash'])->name('lecturers.trash');
    Route::post('lecturers/restore', [CLecturer::class, 'restore'])->name('lecturers.restore');
    Route::delete('lecturers/delete', [CLecturer::class, 'delete'])->name('lecturers.delete');
    Route::resource('lecturers', CLecturer::class);
    // Users
    Route::get('users/trash', [CUser::class, 'trash'])->name('users.trash');
    Route::post('users/restore', [CUser::class, 'restore'])->name('users.restore');
    Route::delete('users/delete', [CUser::class, 'delete'])->name('users.delete');
    Route::resource('users', CUser::class);
});
Route::middleware(['auth', 'verified', 'can:admin'])->prefix('dashboard')->name('dashboard.')->group(function () {


    // Pages
    Route::get('pages/trash', [CPage::class, 'trash'])->name('pages.trash');
    Route::post('pages/restore', [CPage::class, 'restore'])->name('pages.restore');
    Route::delete('pages/delete', [CPage::class, 'delete'])->name('pages.delete');
    Route::resource('pages', CPage::class);

    // Page Category
    Route::get('page-category/trash', [CPageCategory::class, 'trash'])->name('page-category.trash');
    Route::post('page-category/restore', [CPageCategory::class, 'restore'])->name('page-category.restore');
    Route::delete('page-category/delete', [CPageCategory::class, 'delete'])->name('page-category.delete');
    Route::resource('page-category', CPageCategory::class);
    //Slider
    Route::get('sliders/trash', [CSlider::class, 'trash'])->name('sliders.trash');
    Route::post('sliders/restore', [CSlider::class, 'restore'])->name('sliders.restore');
    Route::delete('sliders/delete', [CSlider::class, 'delete'])->name('sliders.delete');
    Route::resource('sliders', CSlider::class);
    //Partner
    Route::get('partners/trash', [CPartner::class, 'trash'])->name('partners.trash');
    Route::post('partners/restore', [CPartner::class, 'restore'])->name('partners.restore');
    Route::delete('partners/delete', [CPartner::class, 'delete'])->name('partners.delete');
    Route::resource('partners', CPartner::class);
    // Testimonials
    Route::get('testimonials/trash', [CTestimonial::class, 'trash'])->name('testimonials.trash');
    Route::post('testimonials/restore', [CTestimonial::class, 'restore'])->name('testimonials.restore');
    Route::delete('testimonials/delete', [CTestimonial::class, 'delete'])->name('testimonials.delete');
    Route::resource('testimonials', CTestimonial::class);

    // Publication
    Route::get('publications/trash', [CPublication::class, 'trash'])->name('publications.trash');
    Route::post('publications/restore', [CPublication::class, 'restore'])->name('publications.restore');
    Route::delete('publications/delete', [CPublication::class, 'delete'])->name('publications.delete');
    Route::resource('publications', CPublication::class);
    //settings
    Route::resource('settings', CSettings::class);

    // Menu
    Route::resource('menu-management', CMenu::class);
});
Route::middleware(['auth', 'verified'])->prefix('dashboard')->name('dashboard.')->group(function () {
    // Categories
    Route::get('categories/trash', [CCategory::class, 'trash'])->name('categories.trash');
    Route::post('categories/restore', [CCategory::class, 'restore'])->name('categories.restore');
    Route::delete('categories/delete', [CCategory::class, 'delete'])->name('categories.delete');
    Route::resource('categories', CCategory::class);
    // News
    Route::get('news/trash', [CNews::class, 'trash'])->name('news.trash');
    Route::post('news/restore', [CNews::class, 'restore'])->name('news.restore');
    Route::delete('news/delete', [CNews::class, 'delete'])->name('news.delete');
    Route::resource('news', CNews::class);
    //Profile
    Route::resource('profile', CProfile::class);

    // Update
    Route::get('/check-update', [UpdaterController::class, 'index'])->name('about.index');
    Route::get('/update', [UpdaterController::class, 'update'])->name('update-version');
});
Route::get('/set-locale/{locale}', [CLocalization::class, 'change'])->name('setLocale');
