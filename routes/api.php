<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::namespace('API')->group(function () {

    Route::get('/events', 'EventController@index')->name('events');
    Route::get('/sports', 'SportController@index')->name('sports');
    Route::get('/teams', 'TeamController@index')->name('teams');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/events', 'EventController@store');
        Route::patch('/events/{theEvent:id}', 'EventController@update')->name('events.update');
        Route::delete('/events/{theEvent:id}', 'EventController@destroy')->name('events.delete');;;

        Route::post('/sports', 'SportCOntroller@store');
        Route::patch('/sports/{sport:id}', 'SportController@update')->name('sports.update');
        Route::delete('/sports/{sport:id}', 'SportController@destroy')->name('sports.delete');

        Route::post('/teams', 'TeamController@store');
        Route::patch('/teams/{team:id}', 'TeamController@update')->name('teams.update');
        Route::delete('/teams/{team:id}', 'TeamController@destroy')->name('teams.delete');
    });

});
