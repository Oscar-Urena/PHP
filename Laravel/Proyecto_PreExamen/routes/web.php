<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $jobs = \App\Models\User::all();
    dd($jobs);
});
