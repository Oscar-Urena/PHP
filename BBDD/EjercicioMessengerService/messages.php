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
$con = (new Connection())->getPdo();
if(isset($_SESSION['usuario'])){
    if(isset($_REQUEST['showmsg'])){
        echo "<h1>Messages sent to {$_SESSION['usuario']}</h1>";
        echo "<hr class='linea'>";
        $stmt = $con->prepare("SELECT iduser FROM users WHERE nick = :usuario");
        $stmt->bindParam(":usuario", $_SESSION['usuario']);
        $stmt->execute();
        $idUser = $stmt->fetch();
        $stmt = $con->prepare("SELECT * FROM messages WHERE refrecipient = :id ");
        $stmt->bindParam(":id", $idUser->iduser);
        $stmt->execute();
        $messages = $stmt->fetchAll();
        echo $stmt->rowCount();
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Subject</th>";
        echo "<th>Sender</th>";
        echo "</tr>";
        $stmt2 = $con->prepare("SELECT name FROM users where iduser = :usuario");
        foreach ($messages as $message) {
            echo $message->idmessage . "<- Id";
            if($message->leido == 0){
                echo "<tr style='background: lightcoral;'>";
            }
        else{
                echo "<tr>";
            }

            echo "<td><a href='messages.php?showmsg=1&msg={$message->idmessage}'>$message->subject</a></td>";
            $stmt2->bindParam(":usuario", $message->refsender);
            $stmt2->execute();
            $recipient = $stmt2->fetch();
            echo "<td>$recipient->name</td>";
            echo "</tr>";
        }
        echo "</table>";

        if(isset($_REQUEST['msg'])){
            $stmt = $con->prepare("UPDATE messages SET leido = 1 WHERE idmessage = :id");
            $stmt->bindParam(":id", $message->idmessage);
            $stmt->execute();
            $stmt = $con->prepare("SELECT * FROM messages WHERE idmessage = :id ");
            $stmt->bindParam(":id", $_REQUEST['msg']);
            $stmt->execute();
            $messages = $stmt->fetch();
            echo "<table border='1'>";
            echo "<tr>";
            echo "<td>Date: $messages->date</td>";
            echo "<td>Time: $messages->time</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td colspan='2'>Subject: $messages->subject</td>";
            echo "</tr>";
            echo "<tr>";
            echo "<td colspan='2'>$messages->body</td>";
            echo "</tr>";
            echo "</table>";

        }
        echo "<p><b>*Click on the message to read it</b></p>";
        echo "<hr class='linea'>";
        echo "<a href='agenda.php'>Return to agenda</a>";
    }else if(!isset($_REQUEST['submit'])){
        echo "<h1>Inbox of " . $_SESSION['usuario'] . "</h1>";
        echo "<hr class='linea'>";
        echo "<form method='post' action='messages.php'>";
        echo "To:<input type='text' name='destinatario' value='{$_REQUEST['recipient']}'><br>";
        echo "From:<input type='text' name='remitente' value='{$_SESSION['usuario']}'><br>";
        echo "Subject: <input type='text' name='subject' placeholder='Subject'><br>";
        echo " <textarea name='message' placeholder='Message'></textarea><br>";
        echo "<input type='submit' name='submit' value='Send'>";
        echo "</form>";
        echo "<hr class='linea'><br>";
        echo "<a href='agenda.php'>Return dashboard</a>";
    }else{
        if(isset($_REQUEST['submit'])){
            $destinatario = $_REQUEST['destinatario'];
            $remitente = $_REQUEST['remitente'];
            if($remitente == $_SESSION['usuario']){

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
                    $stmt->bindParam(":refsender", $idRemitente);
                    $stmt->bindParam(":refrecipient", $idDestinatario);
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
