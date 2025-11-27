<?php
session_start();
require_once 'Conexion.php';
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        img{
            width: 150px;
        }
    </style>
</head>
<body>
<?php
    if(isset($_REQUEST['logout'])){
        session_destroy();
        header("Location: index.php");
    }
    if(isset($_REQUEST['sala'])){
        $teatro = $_SESSION['teatro'];
        $con = (new Connection())->getPdo();
        $stmt = $con->prepare("SELECT * FROM sesiones WHERE teatro = :teatro");
        $stmt->bindParam(':teatro', $teatro);
        $stmt->execute();
        $sesiones = $stmt->fetchAll();
        $stmt = $con->prepare("SELECT * FROM teatros WHERE idTeatro = :teatro");
        $stmt->bindParam(':teatro', $teatro);
        $stmt->execute();
        $teatros = $stmt->fetchAll();

        echo "<table border='1'>";
        foreach ($sesiones as $sesion) {
            echo "<tr><td>$sesion->fecha</td>";
            echo "<td>$sesion->hora</td>";

            $con = (new Connection())->getPdo();
            $stmt = $con->prepare("SELECT * FROM entradas WHERE idSesion = :session");
            $stmt->bindParam(':session', $sesion->id);
            $stmt->execute();
            $entradasVendidas = $stmt->fetchAll();
            $con = (new Connection())->getPdo();
            $stmt = $con->prepare("SELECT * FROM teatros WHERE idTeatro = :teatro");
            $stmt->bindParam(':teatro', $teatro);
            $stmt->execute();
            $entradasPosibles = $stmt->fetchAll();
            $entradasPosibles = $entradasPosibles[0]->filas * $entradasPosibles[0]->columnas;
            if($entradasPosibles > count($entradasVendidas)){
                echo "<td><a href='butacas.php?session=$sesion->idSesion'><img src='./img/tickets.jpeg'></a></td>'";
            }
            else{
                echo "<td><img src='./img/agotadas.jpeg'></td>'";
            }
            echo "</tr>";
        }
        echo "</table>";
        echo"<br><a href='index.php?logout=1' '><button type='button'>Volver a la anterior</button></a>";
    }else{
        if(isset($_REQUEST['teatro'])){
            $_SESSION['teatro'] = $_REQUEST['teatro'];
            header("location:index.php?sala={$_REQUEST['teatro']}");
        }
        else{
            $con = (new Connection())->getPdo();
            $stmt = $con->prepare("SELECT * FROM teatros");
            $stmt->execute();
            $teatros = $stmt->fetchAll();
            echo "<h1>Trassierra Tickets</h1>";
            echo "<table border='1'>";
            foreach($teatros as $teatro){
                echo "<tr>";
                echo "<td><a href='index.php?teatro=$teatro->idTeatro'>".$teatro->teatro."</a></td>";
                echo "<td><img src=" . './img/'.$teatro->imagen."></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
?>
</body>
</html>

