<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class doctorFormServiceProvider extends ServiceProvider
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
        $doctorFormJson = file_get_contents(base_path('resources/data/doctor/form.json'));
        $doctorFormData = json_decode($doctorFormJson);

        \View::share('doctorFormData',[$doctorFormData]);
    }
}
