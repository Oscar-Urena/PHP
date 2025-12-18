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
$temp = [ 78, 60, 62, 68, 71, 68, 73, 85, 66, 64, 76, 63, 75, 76,
    73, 68, 62, 73, 72, 65, 74, 62, 62, 65, 64, 68, 73, 75, 79, 73];
$temp = array_unique($temp);
sort($temp);
echo "Temperatura media: " .  number_format(array_sum($temp)/count($temp), 2) . " grados<br>";
echo "Temperaturas más bajas: " .  implode(",", array_slice($temp, 0, 5)) . "<br>";
echo "Temperaturas más altas: " .  implode(",", array_slice(array_reverse($temp), 0, 5)) . "<br>";
?>
</body>
</html>