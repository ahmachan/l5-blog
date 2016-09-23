<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'demo'], function(){
    Route::get('/', 'Backend\DemoController@index');
    Route::get('facades', 'Backend\DemoController@facades');
    Route::get('getBy', 'Backend\DemoController@getBy');
});



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
//Route::get('login', 'Backend\LoginController@login');
//Route::group(['middleware' => ['web']], function () {
//    //
//
//});


Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::group(['prefix' => 'admin'], function(){
        Route::get('/', 'Backend\HomeController@index');
    });
//    Route::get('/home', 'HomeController@index');
});
