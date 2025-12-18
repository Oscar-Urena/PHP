<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h2>Subida de ficheros</h2>
<?php
$nombreCompleto ="";
if(isset($_REQUEST["submit"])){
    $_Titulo = $_REQUEST["titulo"];
    $_Texto = $_REQUEST["texto"];
    $_Categoria = $_REQUEST["categoria"];
    if(!empty($_FILES["img"])){
        $_img = $_FILES["img"];
        if (is_uploaded_file ($_FILES['img']['tmp_name']))
        {
            $nombreDirectorio = "img/";
            $idUnico = time();
            $nombreFichero = $idUnico . "-" . $_FILES['img']['name'];
            $nombreCompleto = $nombreDirectorio.$nombreFichero;
            move_uploaded_file ($_FILES['img']['tmp_name'],
                $nombreDirectorio . $nombreFichero);
        }
    }
    else
        $_img = "Error subiendo el archivo";
    echo "<h3>Resultado de la inserción de la nueva noticia</h3>
<p>La noticia ha sido recibida correctamente</p>
<ul>
    <li>Título: $_Titulo</li>
    <li>Texto: $_Texto</li>
    <li>Categoria: $_Categoria</li>
    <li>Imagen: <a href='$nombreCompleto'><img alt='No se ha podido subir la imagen' src='$nombreCompleto' width='20px'></a> </li>
</ul>
<a href=$_SERVER[PHP_SELF]>Mandar otra noticia</a>";
}
else{
    echo"
    <form method='POST' enctype='multipart/form-data'>
        <br>Titulo: <input type='text' name='titulo' required>
        <br>Descripción: <textarea name='texto' rows='10' cols='10'></textarea>
        <br>Categoría: <select name='categoria'>
            <option value='oferta'>Oferta</option>
            <option value='fin de semana'>Fin de semana</option>
        </select>
        <br>Imagen: <input type='file' name='img' >
        <br><input type='submit' name='submit' value='Enviar'>
    </form>
";
}
?>
</body>
</html>