<?php

use Illuminate\Support\Facades\Route;

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

// Authentication Routes... we just need login routes...
Route::get('login', [
    'as' => 'login',
    'uses' => 'Auth\LoginController@showLoginForm'
]);
Route::post('login', [
    'as' => '',
    'uses' => 'Auth\LoginController@login'
]);
Route::post('logout', [
    'as' => 'logout',
    'uses' => 'Auth\LoginController@logout'
]);


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', 'Dashboard\DashboardController')->name('dashboard');
    Route::get('/dashboard/{any}', 'Dashboard\DashboardController')->where('any', '.*');
});

Route::get('/{any}', 'Index\HomeController')->name('home')->where('any', '.*');
