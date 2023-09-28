<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class vendorFormServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $vendorFormJson = file_get_contents(base_path('resources/data/vendor/form.json'));
        $vendorFormData = json_decode($vendorFormJson);

        \View::share('vendorFormData',[$vendorFormData]);
    }
}
