<?php

//region use
use App\Http\Controllers\DiakController;
use App\Http\Controllers\OsztalyController;
use App\Http\Controllers\QeriesController;
use App\Http\Controllers\SportController;
use App\Http\Controllers\SportolasController;
use App\Http\Controllers\UsersController;
use App\Http\Middleware\AuthenticateMy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//endregion use

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//region users
Route::post('users/login', [UsersController::class, 'login']);
Route::post('users/logout', [UsersController::class, 'logout']);
Route::get('users', [UsersController::class, 'index'])
    ->middleware('auth:sanctum');

Route::get('users/{id}', [UsersController::class, 'show'])
    ->middleware('auth:sanctum');
Route::post('users', [UsersController::class, 'store'])
    ->middleware('auth:sanctum');    
Route::patch('users/{id}', [UsersController::class, 'update'])
    ->middleware('auth:sanctum');    
Route::delete('users/{id}', [UsersController::class, 'destroy'])
    ->middleware('auth:sanctum');    
//endregion

//region API teszt
Route::get('/', function(){
    return 'API';
});
//endregion

//region sports
Route::get('sports', [SportController::class, 'index']);
Route::get('sports/{id}', [SportController::class, 'show']);
Route::post('sports', [SportController::class, 'store'])
    ->middleware('auth:sanctum');
Route::patch('sports/{id}', [SportController::class, 'update'])
    ->middleware('auth:sanctum');
Route::delete('sports/{id}', [SportController::class, 'destroy'])
    ->middleware('auth:sanctum');
// Route::apiResource('sports', SportController::class);
//endregion

//region osztalies
Route::get('osztalies', [OsztalyController::class, 'index']);
Route::get('osztalies/{id}', [OsztalyController::class, 'show']);
Route::post('osztalies', [OsztalyController::class, 'store'])
    ->middleware('auth:sanctum');
Route::patch('osztalies/{id}', [OsztalyController::class, 'update'])
    ->middleware('auth:sanctum');
Route::delete('osztalies/{id}', [OsztalyController::class, 'destroy'])
    ->middleware('auth:sanctum');
// Route::apiResource('osztalies', OsztalyController::class);
//endregion

//region diaks
Route::get('diaks', [DiakController::class, 'index']);
Route::get('diaks/{id}', [DiakController::class, 'show']);
Route::post('diaks', [DiakController::class, 'store'])
    ->middleware('auth:sanctum');
Route::patch('diaks/{id}', [DiakController::class, 'update'])
    ->middleware('auth:sanctum');
Route::delete('diaks/{id}', [DiakController::class, 'destroy'])
    ->middleware('auth:sanctum');
// Route::apiResource('diaks', DiakController::class);
//endregion

//region sportolas
Route::get('sportolas', [SportolasController::class, 'index']);
Route::get('sportolas/{diakokId}/{sportokId}', [SportolasController::class, 'show']);
Route::post('sportolas', [SportolasController::class, 'store'])
    ->middleware('auth:sanctum');
Route::patch('sportolas/{diakokId}/{sportokId}', [SportolasController::class, 'update'])
    ->middleware('auth:sanctum');
Route::delete('sportolas/{diakokId}/{sportokId}', [SportolasController::class, 'destroy'])
    ->middleware('auth:sanctum');
// Route::apiResource('sportolas', SportolasController::class);
//endregion


//queries
Route::get('queryOsztalynevsorok', [QeriesController::class, 'queryOsztalynevsorok']);
Route::get('/queryOsztalytasrsak/{nev}', [QeriesController::class, 'queryOsztalytasrsak']);
Route::get('/queryOsztalynevsorLimit/{oldal}/{limit}', [QeriesController::class, 'queryOsztalynevsorLimit']);
Route::get('/queryOsztalyOldal/{limit}', [QeriesController::class, 'queryOsztalyOldal']);
Route::get('/queryDiakKeres/{nev}', [QeriesController::class, 'queryDiakKeres']);

