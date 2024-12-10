<?php

use App\Http\Controllers\DiakController;
use App\Http\Controllers\OsztalyController;
use App\Http\Controllers\QueriesController;
use App\Http\Controllers\SportController;
use App\Http\Controllers\SportolasController;
use App\Http\Controllers\UserController;
use App\Models\Diak;
use App\Models\Osztaly;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


//QUERIES
Route::get('/queryOsztalynevsor', [QueriesController::class, 'queryOsztalynevsor']);
Route::get('/queryOsztalytasrsak/{nev}', [QueriesController::class, 'queryOsztalytasrsak']);
Route::get('/queryOsztalynevsorLimit/{oldal}/{limit}', [QueriesController::class, 'queryOsztalynevsorLimit']);
Route::get('/queryHanyOldalVan/{limit}', [QueriesController::class, 'queryHanyOldalVan']);



Route::post('/users/login', [UserController::class, 'login']);
Route::post('/users/logout', [UserController::class, 'logout']);
Route::get('/users', [UserController::class, 'index'])
    ->middleware('auth:sanctum');
Route::get('/users/{id}', [UserController::class, 'show'])
    ->middleware('auth:sanctum');
Route::post('/users', [UserController::class, 'store'])
    ->middleware('auth:sanctum');    
Route::delete('/users/{id}', [UserController::class, 'destroy'])
    ->middleware('auth:sanctum');    
Route::patch('/users/{id}', [UserController::class, 'update'])
    ->middleware('auth:sanctum');



Route::get(uri: '/', action: function(): string{
    return 'API';
});

Route::get('/sports', [SportController::class, 'index']);
Route::get('/sports/{id}', [SportController::class, 'show']);
Route::post('/sports', [SportController::class, 'store'])
    ->middleware('auth:sanctum');
Route::delete('/sports/{id}', [SportController::class, 'destroy'])
    ->middleware('auth:sanctum');
Route::patch('/sports/{id}', [SportController::class, 'update'])
    ->middleware('auth:sanctum');

// Route::apiResource('sports', SportController::class);


Route::get('/osztalies', [OsztalyController::class, 'index']);
Route::get('/osztalies/{id}', [OsztalyController::class, 'show']);
Route::post('/osztalies', [OsztalyController::class, 'store'])
    ->middleware('auth:sanctum');
Route::delete('/osztalies/{id}', [OsztalyController::class, 'destroy'])
    ->middleware('auth:sanctum');
Route::patch('/osztalies/{id}', [OsztalyController::class, 'update'])
    ->middleware('auth:sanctum');


Route::get('/diaks', [DiakController::class, 'index']);
Route::get('/diaks/{id}', [DiakController::class, 'show']);
Route::post('/diaks', [DiakController::class, 'store'])
    ->middleware('auth:sanctum');
Route::delete('/diaks/{id}', [DiakController::class, 'destroy'])
    ->middleware('auth:sanctum');
Route::patch('/diaks/{id}', [DiakController::class, 'update'])
    ->middleware('auth:sanctum');


Route::get('/sportolas', [SportolasController::class, 'index']);
Route::get('/sportolas/{diakokId}/{sportokId}', [SportolasController::class, 'show']);
Route::post('/sportolas', [SportolasController::class, 'store'])
    ->middleware('auth:sanctum');
Route::delete('/sportolas/{diakokId}/{sportokId}', [SportolasController::class, 'destroy'])
    ->middleware('auth:sanctum');
Route::patch('/sportolas/{diakokId}/{sportokId}', [SportolasController::class, 'update'])
    ->middleware('auth:sanctum');


