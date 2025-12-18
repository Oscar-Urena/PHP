<?php
    session_start(); 
?>

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
<?php
if(isset($_SESSION['usuario'])) {
    if(!empty($_SESSION['noticias'])) {
        $_indice = 1;
        foreach ($_SESSION['noticias'] as $noticia) {
            echo "
            <b>Noticia {$_indice}</b>
            <p> {$noticia['titulo']} </p>
            <p> {$noticia['texto']} </p>
            <p> {$noticia['categoria']} </p>
            <img style='width: 300px;' src='{$noticia['img']}'> <br><hr>";
            $_indice++;
        }
        echo "<a href='menu.php'>Volver al menu</a>";
    }
}else{
    header('Location: login.php');
}
?>
</body>
</html>
