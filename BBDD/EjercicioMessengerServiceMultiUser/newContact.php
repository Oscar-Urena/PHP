<?php
    session_start();
    require_once "conexion.php";
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
if(isset($_SESSION["usuario"])){
    echo "<h1>Add a new contact</h1>";
    echo "<hr>";
    $con = (new Connection())->getPdo();
    $stmt = $con->prepare("SELECT iduser FROM users WHERE nick = :nick");
    $stmt->bindValue(":nick", $_SESSION["usuario"][$_REQUEST["indice"]]);
    $stmt->execute();

    $idUsuario = $stmt->fetch()->iduser;

    $stmt = $con->prepare("SELECT iduser, name, nick FROM users WHERE iduser != :yo AND iduser NOT IN ( SELECT idcontact FROM contacts WHERE iduser = :yo2)");
    $stmt->bindValue(":yo", $idUsuario);
    $stmt->bindValue(":yo2", $idUsuario);
    $stmt->execute();

    $contactos = $stmt->fetchAll();

    echo "<ul>";
    foreach ($contactos as $c) {
        echo "<li><a href=''>$c->name</a></li>";
    }
    echo "</ul>";
    echo "<hr>";
    echo "<a href='agenda.php?indice={$_REQUEST['indice']}'>Return to agenda</a>";
}else{
    header("location:index.php");
}
?>
</body>
</html>
