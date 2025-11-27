<?php

require 'Rectangulo.php';
require 'Circulo.php';
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
<form method="post">
    Introduce la x: <input type="text" name="x"><br>
    Introduce la y: <input type="text" name="y"><br>
    Rectángulo: <input type="radio" name="figuraN" value="rectangulo"><br>
    Circulo: <input type="radio" name="figuraN" value="circulo"><br>
    <input type="submit" name="submit" value="submit">
</form>
<?php
if(isset($_POST["submit"])){
    if(isset($_POST["figuraN"])){
        switch($_POST["figuraN"]){
            case "rectangulo":
                $_figura = new Rectangulo($_POST["x"], $_POST["y"]);
                break;
            case "circulo":
                $_figura = new Circulo($_POST["x"], $_POST["y"]);
        }
        echo $_figura->area();
    }
    else{
        echo "Indica qué figura quieres";
    }
}
?>
</body>
</html>