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
    <style>
        .bienvenida{
            display: grid;
            grid-template-rows: 1fr auto;
        }
        .bienvenida p{
            text-align: center;
        }
        .bienvenida-enlaces{
            display: grid;
            grid-template-columns: 1fr 1fr;
            width: 50%;
            text-align: center;
            margin: auto;
        }
        .bienvenida-enlaces a{
            text-decoration: none;
            padding-top: 30px;
        }
        .menu p{
            text-align: center;
        }
        .menu ul{
            width: fit-content;
            margin: auto;
            padding: 30px;
            border: ;
            border-radius: 30px;
            box-shadow: 0px 0px 5px grey;
        }
        .menu li{
            display: inline;
        }
        .menu a{
            padding-inline: 10px;
        }
        .formularioInicio{
            width: fit-content;
            margin: auto;
            padding: 30px;
            border: ;
            border-radius: 30px;
            box-shadow: 0px 0px 5px grey;
        }
        .titulo{
            color: blue;
            text-align: center;
        }
        hr{
            width: 600px;
        }
    </style>
</head>
<body>
<?php

if(isset($_REQUEST['logout'])){
    session_destroy();
    header("location:index.php");
}
if(isset($_REQUEST['vermenu'])){
    $user =htmlspecialchars($_SESSION['usuario']);
    echo "<div class='menu'>";
    echo "<p>Hello, " . $user . "</p>";
    echo  "<ul>";
    echo "<li><a href='index.php?show=1'>Show News</a></li>";
    echo "<li><a href='index.php?add=1'>Add News</a></li>";
    if($user == "antonio"){
        echo "<li><a href='index.php?delete=1'>Delete News</a></li>";
    }
    echo "<li><a href='index.php?logout=1'>Log Out</a></li>";
    echo "</ul>";
    echo "</div>";
}
//else if(isset($_REQUEST['show'])){
//    $con = (new Connection())->getPdo();
//    $stmt = $con->prepare("SELECT * FROM noticias");
//    $stmt->execute();
//    $noticias = $stmt->fetchAll();
//
//
//    echo "<table border='1'>";
//    echo "<tr>";
//    echo "<th>ID</th>";
//    echo "<th>Title</th>";
//    echo "<th>Text</th>";
//    echo "<th>Category</th>";
//    echo "<th>Date</th>";
//    echo "<th>Image</th>";
//    echo "</tr>";
//    foreach($noticias as $noticia){
//        echo "<tr>";
//        echo "<td>" . $noticia->id . "</td>";
//        echo "<td>" . $noticia->titulo . "</td>";
//        echo "<td>" . $noticia->texto . "</td>";
//        echo "<td>" . $noticia->categoria . "</td>";
//        echo "<td>" . $noticia->fecha . "</td>";
//        $enlaceImg = "./img/" . $noticia->imagen;
//        echo "<td> <a href='{$enlaceImg}' target='_blank'>" . $noticia->imagen . "</a><img style='width: 100px' src='{$enlaceImg}' alt='Error en img'></td>";
//        echo "</tr>";
//    }
//    echo "</table>";
//    echo "<a href='index.php?vermenu=1'>Back to Menu</a><br>";
//}
else if(isset($_REQUEST['show'])){
    $filas = 2;
    $start = $_REQUEST['show'];
    $con = (new Connection())->getPdo();
    $stmt = $con->prepare("SELECT * FROM noticias");
    $stmt->execute();
    $count = $stmt->rowCount();
    $con = (new Connection())->getPdo();
    $stmt = $con->prepare("SELECT * FROM noticias limit :start , :filas");
    $stmt->bindParam(":filas", $filas);
    $stmt->bindParam(":start", $start);
    $stmt->execute();
    $noticias = $stmt->fetchAll();


    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>Title</th>";
    echo "<th>Text</th>";
    echo "<th>Category</th>";
    echo "<th>Date</th>";
    echo "<th>Image</th>";
    echo "</tr>";
    foreach($noticias as $noticia){
        echo "<tr>";
        echo "<td>" . $noticia->titulo . "</td>";
        echo "<td>" . $noticia->texto . "</td>";
        echo "<td>" . $noticia->categoria . "</td>";
        echo "<td>" . $noticia->fecha . "</td>";
        $enlaceImg = "./img/" . $noticia->imagen;
        echo "<td> <a href='{$enlaceImg}' target='_blank'>" . $noticia->imagen . "</a><img style='width: 100px' src='{$enlaceImg}' alt='Error en img'></td>";
        echo "</tr>";
    }
    echo "</table>";
    if($start > 1){
        echo "<a href='index.php?show=" . $start-$filas . "'>Previous</a>";
    }else{
        echo "<span style='color: grey' >Previous</span>";
    }
    echo " | ";
    if($start+$filas*2 < $count || $start+$filas+1 == $count){
        echo "<a href='index.php?show=" . $start+$filas . "'>Next</a>";
    }else{
        echo "<span style='color: grey'>Next</span>";
    }

    echo "<hr>";
    echo "<a href='index.php?vermenu=1'>Back to Menu</a><br>";
}
else if(isset($_REQUEST['add'])){
    if(isset($_REQUEST["submit"])){
        $nombreCompleto = "";
        if(isset($_FILES['img'])){
            $img = $_FILES['img']['name'];
            if(is_uploaded_file($_FILES['img']['tmp_name'])){
                $nombreDirectorio = "img/";
                $nombreCompleto = $nombreDirectorio. $_FILES['img']['name'];
                move_uploaded_file($_FILES['img']['tmp_name'], $nombreCompleto);
            }
        }
        else{
            $img = "Imagen no enviada";
        }
        $noticia = [
                'titulo' => $_REQUEST['titulo'],
                'texto' => $_REQUEST['texto'],
                'categoria' => $_REQUEST['categoria'],
                'imagen' => $img
        ];
        $dummie = "Test text";

        $con = (new Connection())->getPdo();
        $stmt = $con->prepare("INSERT INTO noticias (titulo, texto, categoria, fecha, imagen) VALUES (:titulo , :texto , :categoria, current_date, :imagen);");
        $stmt->bindParam(':titulo', $noticia['titulo']);
        $stmt->bindParam(':texto', $noticia['texto']);
        $stmt->bindParam(':categoria', $noticia['categoria']);
        $stmt->bindParam(':imagen', $noticia['imagen']);
        $stmt->execute();

        echo" <a href='" . $_SERVER['PHP_SELF'] . "'>Submit another news article</a>
              <br>
              <a href='index.php?show=1'>List all news</a>";
    }else{
        echo "
            <form method='POST' enctype='multipart/form-data'>
                <br>Title: <input type='text' name='titulo' required>
                <br>Description: <textarea name='texto' rows='10' cols='10'></textarea>
                <br>Category: 
                <select name='categoria'>
                    <option value='ofertas'>Offer</option>
                    <option value='promociones'>Promotion</option>
                    <option value='costas'>Shores</option>
                </select>
                <input type='hidden' name='add' value='add'> 
                <br>Image: <input type='file' name='img'>
                <br><input type='submit' name='submit' value='Submit'>
            </form>
        ";
    }
}
else if(isset($_REQUEST['delete'])){
    if(isset($_REQUEST["submit"])){
        $con = (new Connection())->getPdo();

        $eliminados =  $_REQUEST["eliminado"];
        $stmt = $con->prepare("DELETE FROM noticias where id = :id;");
        foreach($eliminados as $eliminado){
            try {
                $stmt->bindParam(':id', $eliminado);
                $stmt->execute();
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
        header("Location: " . $_SERVER['PHP_SELF']."?delete=1");
    }
    else{
        $con = (new Connection())->getPdo();
        $stmt = $con->prepare("SELECT * FROM noticias");
        $stmt->execute();
        $noticias = $stmt->fetchAll();

        echo "<form method='POST' enctype='multipart/form-data'>";
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Title</th>";
        echo "<th>Text</th>";
        echo "<th>Category</th>";
        echo "<th>Date</th>";
        echo "<th>Delete</th>";
        echo "</tr>";
        foreach($noticias as $noticia){
            echo "<tr>";
            echo "<td>" . $noticia->titulo . "</td>";
            echo "<td>" . $noticia->texto . "</td>";
            echo "<td>" . $noticia->categoria . "</td>";
            echo "<td>" . $noticia->fecha . "</td>";
            echo "<td><input type='checkbox' name='eliminado[]' value='{$noticia->id}'></td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<input type='submit' name='submit' value='Delete'>";
        echo "</form>";
        echo "<a href='index.php?vermenu=1'>Back to Menu</a>";
    }
}
else if(isset($_SESSION['usuario'])){
    echo "<div class='bienvenida'>";
    echo "<p >Hello, you are already logged in ". htmlspecialchars($_SESSION['usuario']). "</p>";
    echo "<div class='bienvenida-enlaces'>";
    echo "<a href='index.php?vermenu=1'>View Menu</a>";
    echo "<a href='index.php?logout=1'>Log Out</a>";
    echo "</div>";
    echo "</div>";
}
else{
    if(!isset($_REQUEST['enviar'])){
        echo "
            <h2 class='titulo'>Log In</h2>
            <hr>
            <form action='' method='POST' class='formularioInicio'>
            <label for='usuario'>Username</label>
            <br>
            <input type='text' name='usuario'><br>
            <label for='password'>Password</label><br>
            <input type='text' name='password'><br><br>
            <input type='submit' name='enviar' value='Submit'>
            </form><hr>";
    }else{
        $usuario = htmlspecialchars($_REQUEST['usuario']);
        $password = htmlspecialchars($_REQUEST['password']);
        $passwordCrypted = md5($password);
        $con = (new Connection())->getPdo();
        try {
            $stmt = $con->prepare("SELECT usuario FROM usuarios WHERE usuario=:usuario and clave=:password");
            $stmt->bindParam(':usuario', $usuario);
            $stmt->bindParam(':password', $passwordCrypted);
            $stmt->execute();
            if($stmt->rowCount() > 0){
                $_SESSION['usuario'] = $usuario;
                header("location:index.php");
            }
            else{
                echo "Incorrect username and/or password";
                echo '<a href=" '. htmlspecialchars($_SERVER['PHP_SELF']) .' ">Exit session</a>';
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }

    }
}
?>
</body>
</html>
