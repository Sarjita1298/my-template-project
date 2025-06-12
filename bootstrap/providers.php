<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // To use DB facade

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
            //     public function boot()
            //     {
            //         // Check if 'settings' table exists before querying it
            //         if (Schema::hasTable('settings')) {
            //             $logo = DB::table('settings')->where('key', 'logo_name')->value('value');

            //             // Now, you can share $logo globally with views or config, for example:
            //             view()->share('logo_name', $logo);
                        
            //             // Or bind it to config if you want:
            //             // config(['app.logo_name' => $logo]);

            //         Schema::defaultStringLength(191); // 👈 Fix for older MySQL versions
            // use Illuminate\Support\Facades\Schema;

                public function boot()
                {
                    Schema::defaultStringLength(191); // 👈 Fix for older MySQL versions

                    // Your existing logic
                    if (Schema::hasTable('settings')) {
                        $logo = DB::table('settings')->where('key', 'logo_name')->value('value');
                        view()->share('logo_name', $logo);
                    }
                }

    //     }
    // }
}


