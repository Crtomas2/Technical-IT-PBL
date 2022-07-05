<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;


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

    public function index()
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
       Schema::defaultstringLength(191);
    }
}
