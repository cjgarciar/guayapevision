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

Route::middleware('auth:passport')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('logueo', 'App\Http\Controllers\AuthController@login');
    Route::post('signup', 'App\Http\Controllers\AuthController@signUp');

    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'App\Http\Controllers\AuthController@logout');
        Route::get('user', 'App\Http\Controllers\AuthController@user');
        Route::get('ver_equipos', 'App\Http\Controllers\EquiposController@ver_equipos');
        Route::post('guardar_equipos', 'App\Http\Controllers\EquiposController@guardar_equipos');
        Route::get('calendario_partidos', 'App\Http\Controllers\CalendarioPartidosController@ver_calendario_partidos');
        Route::post('guardar_calendario_partidos', 'App\Http\Controllers\CalendarioPartidosController@guardar_calendario_partidos');
        Route::get('ver_pagos', 'App\Http\Controllers\PagosController@ver_pagos');
        Route::post('guardar_pagos', 'App\Http\Controllers\PagosController@guardar_pagos');
    });
});