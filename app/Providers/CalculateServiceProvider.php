<?php

namespace App\Providers;

use App\Logic\ServiceCalculate;
use Illuminate\Support\ServiceProvider;

class CalculateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('calculate',function(){
            return new ServiceCalculate();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
