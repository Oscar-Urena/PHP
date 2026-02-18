<!doctype html>
<html lang="en">
<head><meta charset="UTF-8"><title>Add News</title></head>
<body>
<form method="POST" action="/noticias" enctype="multipart/form-data">
    @csrf
    <br>Title: <input type="text" name="titulo" required>
    @error('titulo') <span style="color:red">{{ $message }}</span> @enderror

    <br>Description: <textarea name="texto" rows="5"></textarea>
    @error('texto') <span style="color:red">{{ $message }}</span> @enderror

    <br>Category:
    <select name="categoria">
        <option value="ofertas">Offer</option>
        <option value="promociones">Promotion</option>
        <option value="costas">Shores</option>
    </select>

    <br>Image: <input type="file" name="imagen">
    @error('imagen') <span style="color:red">{{ $message }}</span> @enderror

    <br><input type="submit" value="Submit">
</form>
<a href="/noticias">Back</a>
</body>
</html>
