<?php
if (isset($_POST["color"])) {
    setcookie("bgcolor", $_POST["color"], time() + 3600);
    header("Location: Exercise1.php");
}
$bgcolor = isset($_COOKIE["bgcolor"]) ? $_COOKIE["bgcolor"] : "white";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Selecciona un color</title>
    <style>
        body {
            background-color: <?= htmlspecialchars($bgcolor) ?>;
        }
    </style>
</head>
<body>
<form action="Exercise1.php" method="POST">
    <label><input type="radio" name="color" value="red" <?= ($bgcolor == "red") ? "checked" : ""?> > Red</label><br>
    <label><input type="radio" name="color" value="green" <?= ($bgcolor == "green") ? "checked" : ""?>> Green</label><br>
    <label><input type="radio" name="color" value="blue" <?= ($bgcolor == "blue") ? "checked" : ""?>> Blue</label><br>
    <input type="submit" value="Cambiar color de fondo">
</form>
</body>
</html>
