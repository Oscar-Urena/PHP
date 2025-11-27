<?php


if(!empty($_REQUEST["clasificacion"])){
    $equipos = $_COOKIE["equipos"];
    arsort($equipos);
    echo '<h3>Equipos</h3>';
?>
<table class="table">
    <thead>
    <tr>
        <th>Position</th>
        <th>Team</th>
        <th>Points</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $i = 1;
    foreach($equipos as $equipo => $puntos){
        $team = str_replace('_', ' ', $equipo);
        // 1º Iteración
        // No tenemos número de partidos.
        // Mostar Formulario.


        // 2º Iteración
        // Ya he enviado el número
        // Array en los name de cada input

        // 3º Iteracion
        // Usar la función para añadir los puntos en la cookie


    }
    }
    ?>
    </tbody>
</table>
}


function setPuntosEquipo($equipo, $puntos){
    $equipo = str_replace ("", "-", $equipo);
    $puntosAnteriores = 0;
    if(isset($_COOKIE["equipos"])){
        $equipos = $_COOKIE["equipos"];
        if(isset($equipos[$equipo])){ //$_COOKIE['equipos'][$equipo]
            $puntosAnteriores = $equipos[$equipo];
        }
    }
    setcookie("equipos[$equipos]", $puntos + $puntosAnteriores, time() + (86400 * 30));
}
$url = $_SERVER['PHP_SELF'];
header("Location:$url?clasificacion=true");

$local = $_REQUEST['local'];
$visitante = $_REQUEST['visitante'];
$glocal = $_REQUEST['glocal'];
$gvisitante = $_REQUEST['gvisitante'];
$npartido = $_REQUEST['npartido'];
for($i=0; $i<$npartido; $i++)
{
    if($i = 0; i< $npartido; i++){

}