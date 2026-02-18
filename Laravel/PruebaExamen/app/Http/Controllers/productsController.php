<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\categories;
use Illuminate\Http\Request;

class productsController extends Controller
{
    public function index()
    {
        $categoryId = request('category');
        $categories = categories::all();

        if ($categoryId) {
            $products = products::where('category_id', $categoryId)->get();
        } else {
            $products = products::all();
        }

        return view('listado', [
            'products' => $products,
            'categories' => $categories,
            'selectedCategory' => $categoryId,
        ]);
    }

    public function create()
    {
        $categories = categories::all();
        return view('addNew', ['categories' => $categories, 'product' => null]);
    }

    public function edit($id)
    {
        $product = products::findOrFail($id);
        $categories = categories::all();
        return view('addNew', ['product' => $product, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code'        => 'required',
            'name'        => 'required',
            'quantity'    => 'required|integer',
            'price'       => 'required|numeric',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        products::create($request->all());

        return redirect('/');
    }

    public function show($id)
    {
        $product = products::with('category')->findOrFail($id);
        return view('show', ['product' => $product]);
    }

    public function destroy($id)
    {
        products::findOrFail($id)->delete();
        return redirect('/');
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'code'        => 'required',
            'name'        => 'required',
            'quantity'    => 'required|integer',
            'price'       => 'required|numeric',
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        products::findOrFail($id)->update($request->all());

        return redirect('/');
    }
}
