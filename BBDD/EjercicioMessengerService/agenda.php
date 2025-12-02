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
    $stmt = $con->prepare("SELECT iduser FROM users WHERE nick = :usuario");
    $stmt->bindParam(':usuario', $usuario);
    $stmt->execute();
    $datosUser = $stmt->fetch();
    $stmt = $con->prepare("SELECT idcontact FROM contacts WHERE iduser = :usuario");
    $stmt->bindParam(':usuario', $datosUser->iduser);
    $stmt->execute();
    $contacts = $stmt->fetchAll();
    $stmt = $con->prepare("SELECT name FROM users WHERE iduser = :usuario");
    foreach ($contacts as $contact) {
        echo "<tr>";
        echo "<td>$contact->idcontact</td>";
        $stmt->bindParam(':usuario', $contact->idcontact);
        $stmt->execute();
        $recipient = $stmt->fetch();
        echo "<td>{$recipient->name}</td>";
        echo "<td><a href='messages.php?recipient={$recipient->name}'><img src='./img/msg.png' style='width: 30px'></a></td>";
        echo "</tr>";
    }
    echo "<tr><td><a href='newContact.php'>// New contact</a></td></tr>";
    echo "</table>";
    echo "<hr class='linea'>";
    echo "<a href='messages.php?showmsg=1'>Show messages</a> ";
    echo "<a href='index.php?logout=1'>Log out</a>";

    $stmt = $con->prepare("SELECT count(*) FROM messages WHERE refrecipient = :usuario and leido = 0");
    $stmt->bindParam(':usuario', $_SESSION['usuario']);
    $stmt->execute();
    if($stmt->rowCount() > 0){
        echo "<h3>You have unread messages...{$stmt->rowCount()}</h3>";
    }

}else{
    header('Location: index.php');
}
?>
</body>
</html>
