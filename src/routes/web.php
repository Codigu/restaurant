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
/*
Route::group(['middleware' => ['web', 'auth']], function ($router) {
    $router->group(['prefix' => Config::get('copya.admin_path'), 'namespace' => 'Admin',], function($router){
        $router->get('/', function(){
            return view('vendor.copya.admin.view');
        });
        $router->get('/dashboard', 'UsersController@index')->name('dashboard');

        $router->group(['prefix' => 'pages'], function($router){
            $router->get('/', 'PagesController@index')->name('pages.index');
            $router->get('/add', 'PagesController@create')->name('pages.add');
            $router->get('{id}/edit', 'PagesController@edit')->name('pages.edit');
        });

        $router->group(['prefix' => 'navigations'], function($router){
            $router->get('/', function(){
                return view('vendor.copya.admin.view');
            })->name('navigations.index');
        });

        $router->group(['prefix' => 'forms'], function($router){
            $router->get('/', 'PagesController@index')->name('forms.index');
            $router->get('/add', 'PagesController@create')->name('forms.add');
            $router->get('{id}/edit', 'PagesController@edit')->name('forms.edit');
        });

        $router->group(['prefix' => 'users'], function($router){
            $router->get('/', 'UsersController@index')->name('users');
            $router->get('/add', 'UsersController@index')->name('add.user');
        });
    });
});
*/
