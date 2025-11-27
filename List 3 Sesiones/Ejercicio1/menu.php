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
if (isset($_SESSION['usuario'])) {
    echo "<p>Hola, " . htmlspecialchars($_SESSION['usuario']) . "</p>";
    echo "<p><a href='addNew.php'>Añadir Noticia</a></p>";
    echo "<p><a href='listNew.php'>Mostrar Noticias</a></p>";
    echo "<p><a href='deleteNew.php'>Eliminar Noticia</a></p>";
    echo "<a href='login.php?logout=1'>Salir de la sesión</a>";
} else {
    header("Location: login.php");
}
?>
</body>
</html>
