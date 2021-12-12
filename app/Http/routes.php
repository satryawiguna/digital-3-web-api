<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);

    Route::get('/home', ['as' => 'index', 'uses' => 'HomeController@index']);

    Route::get('/home/priceList', ['as' => 'priceList', 'uses' => 'HomeController@priceList']);

    Route::get('/home/getUserActivate/{email}', ['as' => 'getUserActivate', 'uses' => 'HomeController@getUserActivate']);

    /*Route::get('/home/createGenre', ['as' => 'createGenre', 'uses' => 'HomeController@createGenre']);

    Route::get('/home/createProductGenre', ['as' => 'createProductGenre', 'uses' => 'HomeController@createProductGenre']);

    Route::get('/home/createProductSlug', ['as' => 'createProductSlug', 'uses' => 'HomeController@createProductSlug']);

    Route::get('/home/getAllImage', ['as' => 'getAllImage', 'uses' => 'HomeController@getAllImage']);*/

    Route::auth();

    Route::get('/admin', ['middleware' => ['auth.backend'], 'as' => 'AdminDashboard', 'uses' => 'Admin\DashboardController@index']);
});
