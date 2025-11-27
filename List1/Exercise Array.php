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
$asignaturas = array(
    "dwes"=>[4,6,9,11,13,22,27],
    "proy" =>[2,7],
    "desp"=>[23,28],
    "dwec"=>[12,17,21,24,26,29],
    "ipe"=>[14,18,25],
    "intf"=>[0,3,5,8,19],
    "opt"=>[15,16,20],
    "ing" =>[1,10]
);

// Diccionario de colores por asignatura
$colores = array(
    "dwes" => "#FFD700",
    "proy" => "#ADD8E6",
    "desp" => "#90EE90",
    "dwec" => "#FFB6C1",
    "ipe"  => "#FFA07A",
    "intf" => "#D3D3D3",
    "opt"  => "#E6E6FA",
    "ing"  => "#F0E68C"
);

$acum = 0;
echo ("<table style='border: 1px solid black; border-collapse: collapse;'>");
for($i = 0; $i < 6; $i++) {
    echo "<tr>";
    for($j = 0; $j < 5; $j++) {
        echo "<td style='padding: 20px; border: 1px solid black;";

        foreach ($asignaturas as $padre => $hijo) {
            if(in_array($acum, $hijo)) {
                echo " background-color: " . $colores[$padre] . ";'>" . $padre;
            }
        }

        echo "</td>";
        $acum++;
    }
    echo "</tr>";
}
echo ("</table>");
?>

</body>
</html>