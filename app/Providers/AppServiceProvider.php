<?php

namespace App\Providers;

use App\Models\Navbar;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $navbars = Navbar::orderBy('order')->get();
        // view()->share('navbars', $navbars);
    }
}
