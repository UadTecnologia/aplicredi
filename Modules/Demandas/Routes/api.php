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

Route::middleware('auth:api')->get('/demandas', function (Request $request) {
    return $request->user();
});

Route::prefix('demandas')->group(function () {
    Route::prefix('graficos')->group(function () {
        Route::post('/', 'GraficosController@all');
        Route::post('/render', 'GraficosController@render');
    });
    Route::post('/setores', 'DemandasController@setores');
    Route::post('/assuntos', 'DemandasController@assuntos');
    Route::post('/usuarios', 'DemandasController@usuarios');
});