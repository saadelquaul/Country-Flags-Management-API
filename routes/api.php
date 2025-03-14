<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::apiResource('countries', 'App\Http\Controllers\CountryController');
Route::post('register', 'App\Http\Controllers\AuthController@register');
Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::post('logout', 'App\Http\Controllers\AuthController@logout')->middleware('auth:sanctum');
Route::middleware('auth:sanctum')->get('user', 'App\Http\Controllers\AuthController@user');


