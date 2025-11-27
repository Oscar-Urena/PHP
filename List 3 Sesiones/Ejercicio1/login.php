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
    <title>LogIn</title>
</head>
<body>
<?php
    $usuarios = array(
        "Paco123" => 1234,
        "XxJUANxX"=> 5678,
        "user"=> "user"
    );
    if(isset($_REQUEST['logout'])){
        session_destroy();
        header("Location: login.php");
    }
    if(isset($_SESSION['usuario'])){
        echo '<p>Hola, ya estás loggeado ' . htmlspecialchars($_SESSION['usuario']) . '</p>';
        echo "<a href='menu.php'>Ver el menu</a><br>";
        echo '<a href=" '. htmlspecialchars($_SERVER['PHP_SELF']) .'/?logout=1">Salir de la sesión</a>';
    }
    else{
        if(!isset($_REQUEST['enviar'])){
            echo "
            <form action='' method='POST'>
            <label for='usuario'>Usuario</label>
            <br>
            <input type='text' name='usuario'><br>
            <label for='password'>Contraseña</label><br>
            <input type='text' name='password'><br><br>
            <input type='submit' name='enviar' value='Enviar'>
            </form>
        ";
        }
        else{
            $usuario = $_REQUEST['usuario'];
            $password = $_REQUEST['password'];

            if(isset($usuarios[$usuario]) && $usuarios[$usuario] == $password){
                $_SESSION['usuario'] = $usuario;
                header("Location: menu.php");
            }
            else{
                echo "Usuario y/o contraseña incorrecta";
                echo '<a href=" '. htmlspecialchars($_SERVER['PHP_SELF']) .' ">Salir de la sesión</a>';
            }
        }

    }
?>
</body>
</html>
