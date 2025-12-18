<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Resultados de Partidos</title>
</head>
<body>

<?php
$numRondas = 5;
for ($i = 1; $i <= $numRondas; $i++) {
    if(!isset($_REQUEST["nRnd"])) {
        echo '<h2>Ronda ' . $i . ' Introduce el número de partidos</h2>
    <form method="post">
        <input type="number" name="nRnd" required>
        <br><br>
        <input type="submit" name="submitRnd" value="Continuar">
    </form>';
    }
    else{
        if(isset($_REQUEST["Procesar Partidos"])){
            $numRondas = $_REQUEST["nRnd"];
            echo '<h2>Introduce los partidos</h2>
        <form method="post">
        <input type="hidden" name="nRnd" value="'. $numRondas .'">
        <input type="hidden" name="submit" value="1">
        <table>
            <tr>
                <th>Equipo Local</th><th>Goles</th><th>Equipo Visitante</th><th>Goles</th>
            </tr>';

            for ($i = 0; $i < $numRondas; $i++) {
                echo '<tr>
            <td><input type="text" name="LocalTeam[]" required></td>
            <td><input type="number" name="GoalsLocalTeam[]" required></td>
            <td><input type="text" name="VisitingTeam[]" required></td>
            <td><input type="number" name="GoalsVisitingTeam[]" required></td>
        </tr>';
            }
            echo '</table>
        <br><input type="submit" value="Procesar Partidos">
        </form>';
        }
    }
}

?>


<?php
if (!isset($_REQUEST["submit"])) {

    echo '<h2>Introduce el número de partidos</h2>
    <form method="post">
        <input type="number" name="nRnd" required>
        <br><br>
        <input type="submit" name="submit" value="Continuar">
    </form>';

} elseif (!isset($_REQUEST["LocalTeam"])) {
    // Paso 2: Formulario para ingresar los datos de los partidos
    $numRondas = htmlspecialchars($_REQUEST["nRnd"]);

    echo '<h2>Introduce los datos de los partidos</h2>
    <form method="post">
    <input type="hidden" name="nRnd" value="'. $numRondas .'">
    <input type="hidden" name="submit" value="1">
    <table>
        <tr>
            <th>Equipo Local</th><th>Goles</th><th>Equipo Visitante</th><th>Goles</th>
        </tr>';

    for ($i = 0; $i < $numRondas; $i++) {
        echo '<tr>
            <td><input type="text" name="LocalTeam[]" required></td>
            <td><input type="number" name="GoalsLocalTeam[]" required></td>
            <td><input type="text" name="VisitingTeam[]" required></td>
            <td><input type="number" name="GoalsVisitingTeam[]" required></td>
        </tr>';
    }

    echo '</table>
    <br><input type="submit" value="Procesar Partidos">
    </form>';

} else {
    // Paso 3: Procesar resultados y mostrar tabla de puntos
    $localTeams = $_REQUEST["LocalTeam"];
    $goalsLocal = $_REQUEST["GoalsLocalTeam"];
    $visitingTeams = $_REQUEST["VisitingTeam"];
    $goalsVisiting = $_REQUEST["GoalsVisitingTeam"];

    $equipos = []; // 'NombreEquipo' => ['puntos' => X]

    for ($i = 0; $i < count($localTeams); $i++) {
        $local = trim($localTeams[$i]);
        $visit = trim($visitingTeams[$i]);
        $golesLocal = intval($goalsLocal[$i]);
        $golesVisit = intval($goalsVisiting[$i]);

        // Inicializar equipos si no existen
        if (!isset($equipos[$local])) {
            $equipos[$local] = ['puntos' => 0];
        }
        if (!isset($equipos[$visit])) {
            $equipos[$visit] = ['puntos' => 0];
        }

        // Asignar puntos según el resultado
        if ($golesLocal > $golesVisit) {
            $equipos[$local]['puntos'] += 3;
        } elseif ($golesLocal < $golesVisit) {
            $equipos[$visit]['puntos'] += 3;
        } else {
            $equipos[$local]['puntos'] += 1;
            $equipos[$visit]['puntos'] += 1;
        }
    }

    // Mostrar tabla de puntos
    uasort($equipos, function ($a, $b) {
        return $b['puntos'] - $a['puntos'];
    } );
    echo "<h2>Tabla de Puntos</h2>";
    echo "<table>
            <tr><th>Equipo</th><th>Puntos</th></tr>";
    foreach ($equipos as $nombre => $datos) {
        echo "<tr><td>" . htmlspecialchars($nombre) . "</td><td>" . $datos['puntos'] . "</td></tr>";
    }
    echo "</table>";
}
?>

</body>
</html>
