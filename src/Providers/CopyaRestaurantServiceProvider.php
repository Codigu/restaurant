<?php

namespace CopyaRestaurant\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use CopyaRestaurant\Console\RestaurantMigration;

class CopyaRestaurantServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../resources/assets/js' => base_path('resources/assets/js'),
        ], 'restaurant-scripts');

        $this->publishes([
            __DIR__.'/../../resources/views/' => base_path('resources/views/vendor/copya'),
        ], 'restaurant-views');

        $this->defineRoutes();
    }

    /**
     * Define the Copya routes.
     *
     * @return void
     */
    protected function defineRoutes()
    {
        if (! $this->app->routesAreCached()) {
            $router = app('router');

            $router->group(['namespace' => 'CopyaRestaurant\Http\Controllers'], function ($router) {

                require __DIR__.'/../routes/console.php';
                require __DIR__.'/../routes/web.php';
            });

            $this->mapApiRoutes();
        }
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace' => 'CopyaRestaurant\Http\Controllers\API',
            'prefix' => 'api',
        ], function ($router) {
            require __DIR__.'/../routes/api.php';
        });

        //extended routes
        Route::group([
            'middleware' => 'api',
            'namespace' => 'CopyaRestaurant\Http\Controllers\API',
            'prefix' => 'api',
        ], function ($router) {
            require __DIR__.'/../routes/category.php';
        });
    }

    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([RestaurantMigration::class]);
        }
    }
}