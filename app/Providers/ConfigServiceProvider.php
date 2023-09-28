<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ConfigServiceProvider extends ServiceProvider
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
    {   // get all data from menu.json file
        $userConfigJson = file_get_contents(base_path('resources/data/user/config.json'));
        $userConfigData = json_decode($userConfigJson);
        $assistantConfigJson = file_get_contents(base_path('resources/data/assistant/config.json'));
        $assistantConfigData = json_decode($assistantConfigJson);
        $doctorConfigJson = file_get_contents(base_path('resources/data/doctor/config.json'));
        $doctorConfigData = json_decode($doctorConfigJson);
        $adminConfigJson = file_get_contents(base_path('resources/data/admin/config.json'));
        $adminConfigData = json_decode($adminConfigJson);
        $deliveryboyConfigJson = file_get_contents(base_path('resources/data/deliveryboy/config.json'));
        $deliveryboyConfigData = json_decode($deliveryboyConfigJson);
        // share all menuData to all the views
        \View::share('configData',[$userConfigData, $assistantConfigData,$doctorConfigData,$adminConfigData,$deliveryboyConfigData]);
    }
}
