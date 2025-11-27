<?php
require_once "./Agenda.php";
require_once "./Person.php";
session_start();
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

if (!isset($_SESSION['calendar'])) {
    $_SESSION['calendar'] = new Agenda();
}
$calendar = $_SESSION['calendar'];
if(!isset($_REQUEST['accion']) && !isset($_REQUEST['calculo'])){
    ?>
    <a href="./index.php?accion=agregar">Agregar Persona</a><br>
    <a href="./index.php?accion=eliminar">Eliminar Persona</a><br>
    <a href="./index.php?accion=mostrar">Mostrar Persona</a><br>
    <a href="./index.php?accion=buscar">Buscar Persona</a><br>
    <a href="./index.php?accion=esta">Comprobar si está la persona</a><br>
    <?php
}else if(isset($_REQUEST['accion'])){

        $accion = $_REQUEST['accion'];
        switch ($accion) {
            case 'agregar':
                $msg = 'Agregar';
                $url = 'add';
                break;
            case 'eliminar':
                $msg = 'Eliminar';
                $url = 'delete';
                break;
            case 'mostrar':
                $msg = 'Mostrar';
                $url = 'show';
                break;
            case 'buscar':
                $msg = 'Buscar';
                $url = 'search';
                break;
            case 'esta':
                $msg = 'Esta';
                $url = 'is';
                break;
            default:
                $msg = "Error";
                break;
        }
        ?>
        <h1><?=$msg?> Persona</h1>
        <form action='index.php?calculo=true' method='POST'>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre">
            <input type="text" name="dni" id="dni" placeholder="dni">
            <input type="submit" value="submit">
            <input type="hidden" name="url" value="<?=$url?>">
        </form>
<?php
}else if(isset($_REQUEST['calculo'])){
    $nombre = $_REQUEST['nombre'];
    $dni = $_REQUEST['dni'];
    $url = $_REQUEST['url'];
    $person = new Person($nombre, $dni);
    switch ($url) {
        case 'add':
            $calendar->addPerson($person);
            echo "Persona añadida correctamente.<br>";
            break;
        case 'delete':
            echo $calendar->deletePerson($person) ? "Persona eliminada.<br>" : "No se encontró la persona.<br>";
            break;
        case 'show':
            echo "Mostar";
            echo $calendar->_toString();
            break;
        case 'search':
            $found = $calendar->getPeople();
            foreach ($found as $person) {
                echo $person->toString()."<br>";
            }
            break;
        case 'is':
            echo $calendar->isPerson($person) ? "La persona está en el calendario.<br>" : "No está registrada.<br>";
            break;
        default:
            echo "Error";
    }
    echo "<a href='{$_SERVER["PHP_SELF"]}'>Volver</a>";
}else{
    echo "Hola";
}
?>
</body>
</html>