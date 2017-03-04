<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//public api routes
Route::group(['middleware' => ['api']], function ($router){
    $router->resource('tables', 'TablesController');
    $router->resource('areas', 'AreasController');
    $router->resource('cuisines', 'CuisinesController');
    $router->resource('products', 'ProductsController');
    $router->resource('reservations', 'ReservationsController');
    $router->resource('reservations/{reservation}/tables', 'Reservations\TablesController');
    $router->resource('reservations/{reservation}/cuisines', 'Reservations\CuisinesController');
    $router->resource('orders', 'OrdersController');
    $router->resource('orders/{order}/cuisines', 'Orders\CuisinesController');
    $router->resource('orders/{order}/products', 'Orders\ProductsController');
    $router->resource('session/reservations', 'Sessions\ReservationsController');
    $router->resource('session/cuisines', 'Sessions\CuisinesController');
});

//authenticated api routes
Route::group(['middleware' => ['auth:api']], function ($router){

});
