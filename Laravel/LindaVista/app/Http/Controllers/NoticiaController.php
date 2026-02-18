<?php

namespace App\Http\Controllers;

use App\Models\Noticia;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
    public function index()
    {
        $noticias = Noticia::paginate(2);
        return view('index', ['noticias' => $noticias]);
    }

    public function create()
    {
        return view('noticiascreate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'    => 'required',
            'texto'     => 'required',
            'categoria' => 'required',
            'imagen'    => 'nullable|image',
        ]);

        $imagen = null;
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen')->getClientOriginalName();
            $request->file('imagen')->move(public_path('img'), $imagen);
        }

        Noticia::create([
            'titulo'    => $request->titulo,
            'texto'     => $request->texto,
            'categoria' => $request->categoria,
            'imagen'    => $imagen,
            'fecha'     => now()->toDateString(),
        ]);

        return redirect('/noticias');
    }

    public function destroy(Request $request)
    {
        $ids = $request->input('eliminado', []);
        Noticia::whereIn('id', $ids)->delete();
        return redirect('/noticias/delete');
    }

    public function showDelete()
    {
        $noticias = Noticia::all();
        return view('delete', ['noticias' => $noticias]);
    }
}
