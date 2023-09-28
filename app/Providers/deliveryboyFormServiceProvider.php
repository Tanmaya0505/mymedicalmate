<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class deliveryboyFormServiceProvider extends ServiceProvider
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
        $deliveryBoyFormJson = file_get_contents(base_path('resources/data/deliveryboy/form.json'));
        $deliveryBoyFormData = json_decode($deliveryBoyFormJson);

        \View::share('deliveryboyFormData',[$deliveryBoyFormData]);
    }
}
