<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/list', function () {
    return view('list');
});

Route::get('/create', function () {
    return view('create');
});
