<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Navbar;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Helpers\Util;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Paginator::useBootstrap();

        View::composer('*', function ($view) {
            $navbars = Navbar::orderBy('ordering')->get();
            Log::debug(Util::format_var($navbars));
            $view->with('navbars', $navbars);
        });
    }
}
