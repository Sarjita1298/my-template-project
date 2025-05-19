<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Setting; // ✅ Add this
use Illuminate\Pagination\Paginator;


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
    // public function boot(): void
    // {
    //     Schema::defaultStringLength(191);

    // }
    // use App\Models\Setting;



    public function boot()
    {
        // $logoName = Setting::where('key', 'logo_name')->value('value') ?? 'AdminLTE 3';      //through .env
        // View::share('logo_name', $logoName);

        $logoName = Setting::where('key', 'logo_name')->value('value') ?? 'Default Brand Name';
        View::share('logo_name', $logoName);


    Paginator::useBootstrapFive(); // Optional: use Bootstrap 4 if needed


    }
}



