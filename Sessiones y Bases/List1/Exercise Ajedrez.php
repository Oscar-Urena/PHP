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

echo "<table border='1' cellspacing='0' cellpadding='0'>";
$toggle=true;
for ($i = 0; $i < 8; $i++) {
    $toggle=!$toggle;
    echo "<tr>";
    for ($j = 0; $j < 8; $j++) {
        $color = $toggle ? "black" : "white";
        echo "<td style='background-color: $color; width: 40px; height: 40px;'></td>";
        $toggle = !$toggle;
    }
    echo "</tr>";
}
echo "</table>";
?>

</body>
</html>