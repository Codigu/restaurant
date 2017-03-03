<?php

use Illuminate\Support\Facades\Config;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/* admin pages */

Route::group(['middleware' => ['web', 'auth']], function ($router) {
    $router->group(['prefix' => Config::get('copya.admin_path'), 'namespace' => 'Admin',], function($router){

        $router->group(['prefix' => 'reservations'], function($router){
            $router->get('/', 'ReservationController@index')->name('reservations.index');
        });

    });
});


Route::group(['middleware' => ['web']], function ($router) {
    $router->get('/reservation', 'Frontend\ReservationsController@index')->name('products.index');
    $router->get('/shop', 'Frontend\ProductsController@index')->name('shop.index');
    $router->get('/checkout', 'Frontend\CheckoutController@doCheckout')->name('shop.checkout');
});