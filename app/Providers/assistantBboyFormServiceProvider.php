<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class assistantBboyFormServiceProvider extends ServiceProvider
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
        $assistantBoyFormJson = file_get_contents(base_path('resources/data/assistant/form.json'));
        $assistantBoyFormData = json_decode($assistantBoyFormJson);

        \View::share('assistantBoyFormData',[$assistantBoyFormData]);
    }
}
