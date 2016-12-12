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

Route::get('/pages', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['middleware' => ['auth:api']], function ($router){
    $router->resource('users', 'UsersController');
    $router->resource('pages', 'PagesController');
    $router->resource('navigations', 'NavigationsController');
    $router->resource('menus', 'MenusController');
    $router->resource('forms', 'FormsController');

    $router->get('routes', 'RoutesController@index');
    $router->get('layouts', 'PagesController@getTemplates');
});
