<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $categoryID = request('category');

    if($categoryID){
        $products = \App\Models\Products::where('category_id', $categoryID)->get();
    } else {
        $products = \App\Models\Products::all();
    }

    return view('listado', [
        'categories' => \App\Models\Categories::all(),
        'products' => $products,
        'selectedCategory' => $categoryID  // ← Agregado para mantener selección
    ]);
});

Route::get('/add', function () {
    return view('addNew');
});

Route::get('/show/{id}', function () {
    $product = \App\Models\Products::find(request('id'));
    return view('show',[
        'product' => $product
    ]);
});
