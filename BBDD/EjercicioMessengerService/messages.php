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
    if(!isset($_REQUEST['submit'])){
        echo "<h1>Inbox of " . $_SESSION['usuario'] . "</h1>";
        echo "<hr class='linea'>";
        echo "<form method='post' action='messages.php'>";
        echo "To:<input type='text' name='destinatario' placeholder='Receiver'><br>";
        echo "From:<input type='text' name='remitente' value='{$_SESSION['usuario']}'><br>";
        echo "Subject: <input type='text' name='subject' placeholder='Subject'><br>";
        echo " <textarea name='message' placeholder='Message'></textarea><br>";
        echo "<input type='submit' name='submit' value='Send'>";
        echo "</form>";
        echo "<hr class='linea'>";
        echo "<a href='agenda.php'>Return dashboard</a>";
    }else{
        if(isset($_REQUEST['submit'])){
            $destinatario = $_REQUEST['destinatario'];
            $remitente = $_REQUEST['remitente'];
            if($remitente == $_SESSION['usuario']){
                $con = (new Connection())->getPdo();
                $stmt = $con->prepare("SELECT idUser FROM users WHERE nick = :usuario");
                $stmt->bindParam(":usuario", $remitente);
                $stmt->execute();
                $idRemitente = $stmt->fetchColumn();
                $stmt = $con->prepare("SELECT idUser FROM users WHERE name = :usuario");
                $stmt->bindParam(":usuario", $destinatario);
                $stmt->execute();
                $idDestinatario = $stmt->fetchColumn();
                echo $idDestinatario . " - " . $idRemitente;
                if($idRemitente == $idDestinatario){
                    echo "<h1>ERROR</h1>";
                    echo "<p>You can not send a message to yourself</p>";
                    echo "<a href='messages.php'>Send another message</a><br>";
                    echo "<a href='agenda.php'>Return dashboard</a>";
                }elseif (!$idDestinatario) {
                    echo "<h1>ERROR</h1>";
                    echo "<p>Destinatario no encontrado</p>";
                    echo "<a href='messages.php'>Send another message</a><br>";
                    echo "<a href='agenda.php'>Return dashboard</a>";
                }else{
                    $stmt = $con->prepare("INSERT INTO messages (refsender, refrecipient, date, time, subject, body) VALUES (:refsender, :refrecipient, current_date, current_time, :subject, :body)");
                    $stmt->bindParam(":refsender", $remitente);
                    $stmt->bindParam(":refrecipient", $destinatario);
                    $stmt->bindParam(":subject", $_REQUEST['subject']);
                    $stmt->bindParam(":body", $_REQUEST['message']);
                    $stmt->execute();
                    header("Location: agenda.php");
                }
            }else{
                echo "<h1>You can not send data as someone else.</h1>";
            }
        }
    }
}else{
    header("location:index.php");
}
?>
</body>
</html>
