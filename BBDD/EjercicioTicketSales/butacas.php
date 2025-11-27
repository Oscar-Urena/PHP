<?php
    session_start();
    require_once "Conexion.php";
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
$con = (new Connection())->getPdo();
$stmt = $con->prepare("SELECT * FROM teatros");
echo "<a href='index.php?sala={$_SESSION['teatro']}'><button type='button'>Cancelar</button></a>";
echo "<a href='butacas.php?venta=1'><button type='button'>Aceptar</button></a>";

?>
</body>
</html>
