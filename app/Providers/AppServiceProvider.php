<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //I have some pretty dangerous things here...
        if ($this->app->environment() == 'local') {
            $this->app->register('Iannazzi\Generators\ImporterServiceProvider');

        }
        else if ($this->app->environment() == 'staging'){
            $this->app->register('Iannazzi\Generators\ImporterServiceProvider');
        }
        else if(($this->app->environment() == 'production')){
            
        }
    }
}
