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
if(isset($_REQUEST['logout'])){
    session_destroy();
    header("Location: index.php");
}
if(isset($_REQUEST["submit"]) && !isset($_REQUEST["extra"])){
        $usuario = $_REQUEST["usuario"];
        $password = $_REQUEST["password"];
        $con = (new Connection())->getPdo();
        try{
            $stmt = $con->prepare("SELECT * FROM users WHERE nick = :usuario AND password = :password");
            $stmt->bindParam(":usuario", $usuario);
            $stmt->bindParam(":password", $password);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                if(!isset($_SESSION["usuario"][0])){
                    $_SESSION["usuario"] = [];
                }
                array_push($_SESSION["usuario"], $usuario);
                $indice = array_search($usuario, $_SESSION["usuario"]);
                header("Location: agenda.php?indice=$indice");
            }else{
                echo "Lo siento, usuario o password incorrecto";
                "<a href='index.html'>Volver</a>";
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            echo "<a href='index.html'>Volver</a>";
        }
    }
    else{
        echo "<h1>LoGiN</h1>";
        echo "<hr class='linea'>";
        echo "<form action='index.php' method='post'>";
        echo "<input type='text' name='usuario' placeholder='Usuario'><br>";
        echo "<input type='password' name='password' placeholder='Password'><br>";
        echo "<hr class='linea'>";
        echo "<input type='submit' name='submit' value='Entrar'>";
    }

?>
</body>
</html>
