<!doctype html>
<html lang="en">
<head><meta charset="UTF-8"><title>Delete News</title></head>
<body>
<form method="POST" action="/noticias/delete">
    @csrf
    <table border="1">
        <tr>
            <th>Title</th><th>Text</th><th>Category</th><th>Date</th><th>Delete</th>
        </tr>
        @foreach($noticias as $noticia)
            <tr>
                <td>{{ $noticia->titulo }}</td>
                <td>{{ $noticia->texto }}</td>
                <td>{{ $noticia->categoria }}</td>
                <td>{{ $noticia->fecha }}</td>
                <td><input type="checkbox" name="eliminado[]" value="{{ $noticia->id }}"></td>
            </tr>
        @endforeach
    </table>
    <input type="submit" value="Delete">
</form>
<a href="/noticias">Back to Menu</a>
</body>
</html>
