<!doctype html>
<html lang="en">
<head><meta charset="UTF-8"><title>Noticias</title></head>
<body>
<p>Hello, {{ session('usuario') }}</p>
<ul style="display:flex; list-style:none; gap:20px;">
    <li><a href="/noticias">Show News</a></li>
    <li><a href="/noticias/create">Add News</a></li>
    @if(session('usuario') === 'antonio')
        <li><a href="/noticias/delete">Delete News</a></li>
    @endif
    <li><a href="/logout">Log Out</a></li>
</ul>

<table border="1">
    <tr>
        <th>Title</th><th>Text</th><th>Category</th><th>Date</th><th>Image</th>
    </tr>
    @foreach($noticias as $noticia)
        <tr>
            <td>{{ $noticia->titulo }}</td>
            <td>{{ $noticia->texto }}</td>
            <td>{{ $noticia->categoria }}</td>
            <td>{{ $noticia->fecha }}</td>
            <td>
                @if($noticia->imagen)
                    <a href="/img/{{ $noticia->imagen }}" target="_blank">
                        <img src="/img/{{ $noticia->imagen }}" style="width:100px" alt="img">
                    </a>
                @endif
            </td>
        </tr>
    @endforeach
</table>

{{-- Paginación --}}
<div style="margin-top:10px;">
    {{ $noticias->previousPageUrl()
        ? '<a href="'.$noticias->previousPageUrl().'">Previous</a>'
        : '<span style="color:grey">Previous</span>' }}
    |
    {{ $noticias->hasMorePages()
        ? '<a href="'.$noticias->nextPageUrl().'">Next</a>'
        : '<span style="color:grey">Next</span>' }}
</div>
</body>
</html>
