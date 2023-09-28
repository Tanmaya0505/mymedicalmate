<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class FrontendSourceMenuServiceProvider extends ServiceProvider
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
        $userMenuJson = file_get_contents(base_path('resources/data/user/menu.json'));
        $userMenuData = json_decode($userMenuJson);
        $assistantBoyMenuJson = file_get_contents(base_path('resources/data/assistant/menu.json'));
        $assistantBoyMenuData = json_decode($assistantBoyMenuJson);
        $doctorMenuJson = file_get_contents(base_path('resources/data/doctor/menu.json'));
        $doctorMenuData = json_decode($doctorMenuJson);
        $vendorMenuJson = file_get_contents(base_path('resources/data/vendor/menu.json'));
        $vendorMenuData = json_decode($vendorMenuJson);
        $deliveryboyMenuJson = file_get_contents(base_path('resources/data/deliveryboy/menu.json'));
        $deliveryboyMenuData = json_decode($deliveryboyMenuJson);
        // $verticalOverlayMenu = file_get_contents(base_path('resources/data/menus/vertical-overlay-menu.json'));
        // $verticalOverlayMenuData = json_decode($verticalOverlayMenu);

        // share all menuData to all the views
        \View::share('frontendSourceMenuData',[$userMenuData, $assistantBoyMenuData,$doctorMenuData,$vendorMenuData,$deliveryboyMenuData]);
    }
}
