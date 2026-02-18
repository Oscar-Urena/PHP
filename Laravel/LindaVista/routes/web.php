<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NoticiaController;

Route::get('/',         [NoticiaController::class, 'index']);
Route::get('/noticias/create',  [NoticiaController::class, 'create']);
Route::post('/noticias',        [NoticiaController::class, 'store']);
Route::get('/noticias/delete',  [NoticiaController::class, 'showDelete']);
Route::post('/noticias/delete', [NoticiaController::class, 'destroy']);
