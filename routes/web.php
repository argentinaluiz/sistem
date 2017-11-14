<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//Route::get('/home', 'HomeController@index')->middleware('web');

Route::group(['middleware' => 'web'], function (){
    Auth::routes();

    Route::get('/home', 'HomeController@index');
    //Upload
    //Route::any(['prefix' => 'upload-files']);

    Route::resource('upload-files', 'FileController');
    Route::resource('upload-contabil', 'FileContabilController');
    Route::resource('upload-tecfin', 'FileTecFinController');
    Route::resource('upload-civil', 'FileCivilController');
    Route::resource('upload-imovelg', 'FileImovelgController');
    Route::resource('upload-imovela', 'FileImovelaController');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){
    // Authentication Routes...
    $this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
    $this->post('login', 'Auth\LoginController@login');
    $this->post('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes...
//    $this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//    $this->post('register', 'Auth\RegisterController@register');

    // Password Reset Routes...
    $this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    $this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    $this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    $this->post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::group(['middleware' =>]);

    Route::get('/home', 'HomeAdminController@index')->name('home');
});

