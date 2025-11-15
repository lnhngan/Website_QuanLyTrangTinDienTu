<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; 
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Code này bảo Laravel:
        // "Bất cứ khi nào mày render cái layout 'layouts.app',
        // hãy tự động chạy 1 câu query lấy TẤT CẢ danh mục
        // và nhét vào biến $categories"
        View::composer('layouts.app', function ($view) {
            $view->with('categories', Category::all());
        });
    }
}
