<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Utility\MyLogger3;
use App\Services\Utility\MyLogger2;
use App\Services\Utility\MyLogger4;

class LoggingServiceProvider extends ServiceProvider
{
    protected $defer = true;
    
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton('App\Services\Utility\ILogger', function($app)
        {
            return new MyLogger4();
        });
    }
    
    /**
     * For deferred providers only return the interface that this provider implements.
     * {@inheritDoc}
     * @see \Illuminate\Support\ServiceProvider::provides()
     */
    public function provides()
    {
        echo "Deferred true and I am here in provides()";
        return ['App\Services\Utility\ILogger'];
    }
}
