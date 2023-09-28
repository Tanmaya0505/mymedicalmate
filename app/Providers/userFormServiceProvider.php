<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class userFormServiceProvider extends ServiceProvider
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
        $userFormJson = file_get_contents(base_path('resources/data/user/form.json'));
        $userFormData = json_decode($userFormJson);

        \View::share('userFormData',[$userFormData]);
    }
}
