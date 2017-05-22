<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your Module. Just tell Your app the URIs it should respond to
| using a Closure or controller method. Build something great!
|
*/

use Illuminate\Routing\Router;

Route::group(['prefix' => 'admin', 'middleware' => 'auth.admin'], function (Router $router) {
    $router->group(['prefix' => 'pages'], function (Router $router) {
        $router->get('', 'PageController@index')->name('pages.index')->middleware('has-permission:view-pages');

        $router->post('', 'PageController@index')->name('pages.index')->middleware('has-permission:view-pages');

        $router->get('create', 'PageController@create')->name('pages.create')->middleware('has-permission:create-pages');

        $router->post('create', 'PageController@store')->name('pages.store')->middleware('has-permission:create-pages');

        $router->get('edit/{id}', 'PageController@edit')->name('pages.edit')->middleware('has-permission:edit-pages');

        $router->post('edit/{id}', 'PageController@update')->name('pages.update')->middleware('has-permission:edit-pages');

        $router->delete('{id}', 'PageController@destroy')->name('pages.destroy')->middleware('has-permission:delete-pages');
    });
});



