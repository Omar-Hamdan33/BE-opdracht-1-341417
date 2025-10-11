<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/warehouse', [App\Http\Controllers\Warehouse::class, 'index']);
Route::get('/alergeen/{id}', [App\Http\Controllers\Warehouse::class, 'alergeen']);
Route::get('/leverancier/{id}', [App\Http\Controllers\Warehouse::class, 'leverancier']);
