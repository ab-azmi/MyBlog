<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Abouts;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
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
        Paginator::useBootstrap();

        $categories = Category::withCount('posts')->orderBy('posts_count', 'DESC')->take(10)->get();
        View::share('navbar_categories', $categories);

        $abouts = Abouts::find(1);
        View::share('abouts', $abouts);
    }
}
