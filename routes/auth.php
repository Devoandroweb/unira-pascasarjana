<?php

use App\Http\Controllers\Auth\CAuth;
use App\Http\Controllers\Auth\CResetPassword;
use App\Http\Controllers\Auth\CVerification;
use Illuminate\Support\Facades\Route;


// Auth Route
Route::post('auth', [CAuth::class, 'auth'])->middleware('guest')->name('auth');
Route::get('/login', [CAuth::class, 'index'])->middleware('guest')->name('login');
Route::get('/logout', [CAuth::class, 'logout'])->middleware('auth')->name('logout');

// Verify Email
Route::get('/verify-email', [CVerification::class, 'show'])->middleware('auth')->name('verification.notice');
Route::post('/resend', [CVerification::class, 'resend'])->name('verification.resend');
Route::get('/verify/{id}/{hash}', [CVerification::class, 'verify'])->name('verification.verify');


// Forgot Password
Route::get('forgot-password', [CResetPassword::class, 'index'])->middleware('guest')->name('forgot-password');
Route::post('/send-reset-link', [CResetPassword::class, 'sendResetLink'])->middleware('guest')->name('forgot-password.send');
Route::get('reset-password/{token}', [CResetPassword::class, 'showResetForm'])->name('password.reset');
Route::post('change-password', [CResetPassword::class, 'update'])->name('password.update');
