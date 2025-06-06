<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\UserPolicy;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
     
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (session()->has('locale')) {
            App::setLocale(session('locale'));
        } else {
            App::setLocale(config('app.locale'));
        }
        Gate::define('admin', [UserPolicy::class, 'admin']);
        Gate::define('author', [UserPolicy::class, 'author']);
      
    }
}
