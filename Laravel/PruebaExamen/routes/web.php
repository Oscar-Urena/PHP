<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\productsController;

Route::get('/',          [productsController::class, 'index']);
Route::get('/add',       [productsController::class, 'create']);
Route::get('/show/{id}', [productsController::class, 'show']);
Route::get('/edit/{id}',  [productsController::class, 'edit']);

Route::put('/edit/{id}',  [productsController::class, 'update']);

Route::post('/add',      [productsController::class, 'store']);

Route::delete('/delete/{id}', [productsController::class, 'destroy']);
