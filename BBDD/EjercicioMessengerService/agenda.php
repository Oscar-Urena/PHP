<?php
    session_start();
    require "conexion.php";
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
if(isset($_SESSION['usuario'])){
    $usuario = $_SESSION['usuario'];
    echo "<h2>{$usuario} dashboard</h2>";
    echo "<hr class='linea'>";
    echo "<table>";
    echo "<tr>";
    echo "<th>User</th>";
    echo "<th>Name</th>";
    echo "<th>Message</th>";
    echo "<th>Delete</th>";
    echo "</tr>";
    $con = (new Connection())->getPdo();
    $stmt = $con->prepare("SELECT * FROM users WHERE nick = :usuario");
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();
    $datosUser = $stmt->fetch();
    $stmt = $con->prepare("SELECT * FROM messages WHERE refsender=:usuario");
    $stmt->bindParam(':usuario', $datosUser->iduser);
    $stmt->execute();
    $mensajes = $stmt->fetchAll();
    foreach ($mensajes as $mensaje) {
        echo "<tr>";
        echo "<td>{$mensaje->idmessage}</td>";
        echo "<td>{$mensaje->refrecipient}</td>";
        echo "<td><a href='messages.php'><img src='./img/msg.png' style='width: 30px'></a></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "<hr class='linea'>";
}else{
    header('Location: index.php');
}
?>
</body>
</html>
