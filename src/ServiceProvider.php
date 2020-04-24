<?php

namespace PublicHolidays;

use PublicHolidays\Commands\Holidays;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__.'/config/public-holidays.php' => config_path('public-holidays.php'),
        ], 'public-holidays-config');

        $this->loadMigrationsFrom(realpath(dirname(__FILE__).'/../database/migrations'));

        $this->commands([
            Holidays::class,
        ]);
    }
}
