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
    $router->resource('cuisines', 'CuisinesController');
    $router->resource('products', 'ProductsController');
});

//authenticated api routes
Route::group(['middleware' => ['auth:api']], function ($router){

});
