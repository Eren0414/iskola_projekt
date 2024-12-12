<?php

use App\Http\Controllers\DiakController;
use App\Http\Controllers\OsztalyController;
use App\Http\Controllers\QueriesController;
use App\Http\Controllers\SportController;
use App\Http\Controllers\SportolasController;
use App\Models\Diak;
use App\Models\Osztaly;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get(uri: '/', action: function(): string{
    return 'API';
});

//QUERIES
Route::get('/queryOsztalynevsor', [QueriesController::class, 'queryOsztalynevsor']);
Route::get('/queryOsztalytarsak/{nev}', [QueriesController::class, 'queryOsztalytarsak']);
Route::get('/queryOsztalyOldal/{param1}/{param2}', [QueriesController::class, 'queryOsztalyOldal']);
Route::get('/queryOsztalyOldalSzam/{darab}', [QueriesController::class, 'queryOsztalyOldalSzam']);

Route::get('/sports', [SportController::class, 'index']);
Route::get('/sports/{id}', [SportController::class, 'show']);
Route::post('/sports', [SportController::class, 'store']);
Route::delete('/sports/{id}', [SportController::class, 'destroy']);
Route::patch('/sports/{id}', [SportController::class, 'update']);

// Route::apiResource('sports', SportController::class);


Route::get('/osztalies', [OsztalyController::class, 'index']);
Route::get('/osztalies/{id}', [OsztalyController::class, 'show']);
Route::post('/osztalies', [OsztalyController::class, 'store']);
Route::delete('/osztalies/{id}', [OsztalyController::class, 'destroy']);
Route::patch('/osztalies/{id}', [OsztalyController::class, 'update']);


Route::get('/diaks', [DiakController::class, 'index']);
Route::get('/diaks/{id}', [DiakController::class, 'show']);
Route::post('/diaks', [DiakController::class, 'store']);
Route::delete('/diaks/{id}', [DiakController::class, 'destroy']);
Route::patch('/diaks/{id}', [DiakController::class, 'update']);


Route::get('/sportolas', [SportolasController::class, 'index']);
Route::get('/sportolas/{diakokId}/{sportokId}', [SportolasController::class, 'show']);
Route::post('/sportolas', [SportolasController::class, 'store']);


