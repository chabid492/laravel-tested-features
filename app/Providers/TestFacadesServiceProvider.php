<?php

namespace App\Providers;
use App;
use Illuminate\Support\ServiceProvider;
use App\Custom\TestClass;

class TestFacadesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('test',function() {
            return new TestClass();
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
