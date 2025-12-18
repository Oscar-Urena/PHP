<?php
    session_start();
    require "Connection.php"
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
$fecha = Date("2025-12-10");
$con = (new Connection())->getPdo();
echo "Available pitches at $fecha."; 
$stmt = $con->prepare("SELECT * FROM types");
$stmt->execute();
$tipos = $stmt->fetchAll();
$stmt = $con->prepare("SELECT * FROM pitches");
$stmt->execute();
$pitchesRaw = $stmt->fetchAll();
$stmt = $con->prepare("SELECT * FROM reservations where arrivalDate >= :fechaEntrada and departureDate <= :fechaSalida");
$stmt->bindParam(':fechaEntrada', $fecha);
$stmt->bindParam(':fechaSalida', $fecha);
$stmt->execute();
$reservations = $stmt->fetchAll();

echo "<div style='margin: auto; width: 500px;'>";
foreach ($tipos as $tipo) {
    echo "Pitches $tipo->name:<br>";
    foreach ($pitchesRaw as $pitch) {
        if ($pitch->type == $tipo->id ) {
            $booked = false;
            foreach ($reservations as $reserve) {
                if ($reserve->pitchNumber == $pitch->number) {
                    $booked = true;
                }
            }
            if (!$booked) {
                echo "<a href='book.php?pitch=$pitch->number'>$pitch->number</a><br>";
            }
        }
    }
}
echo "</div>";
echo "<a href='index.php'><button>Home</button></a>";
?>
</body>
</html>
