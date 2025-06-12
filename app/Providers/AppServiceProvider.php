<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // You can register bindings or singletons here if needed
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fix string length issue for older MySQL versions
        Schema::defaultStringLength(191);

        // Retrieve logo_name from settings table, fallback to default
        $logoName = Setting::where('key', 'logo_name')->value('value') ?? 'Default Brand Name';

        // Share $logoName with all views as 'logo_name'
        View::share('logo_name', $logoName);
        
        View::composer('*', function ($view) {
        $cart = Session::get('cart', []);
        $cartCount = collect($cart)->sum('quantity');
        $view->with('cartCount', $cartCount);
    });

        // Use Bootstrap 5 styling for pagination links
        Paginator::useBootstrapFive();
    }
}
