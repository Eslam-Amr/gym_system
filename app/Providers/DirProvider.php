<?php

namespace App\Providers;

use Illuminate\View\View;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class DirProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Facades\View::composer('admin/partials/head', function (View $view) {
            return $view->with('dir', LaravelLocalization::getCurrentLocale() == 'ar' ? 'assets-admin-rtl' : 'assets-admin');
        });
        Facades\View::composer('admin/auth/master', function (View $view) {
            return $view->with('dir', LaravelLocalization::getCurrentLocale() == 'ar' ? 'assets-admin-rtl' : 'assets-admin');
        });
    }
}
