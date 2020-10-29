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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('users','UserController@store');
Route::post('login','UserController@login');

//Protegemos nuestras rutas con el middleware auth:api
Route::group(['middleware'=>'auth:api'], function(){
    //las rutas de directorios (puedo chequer todas las rutas ejecutando el comando php artisan route:list
    Route::apiResource('directorios','DirectorioController');
    Route::post('logout', 'UserController@logout');
});
