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
$con = (new Connection())->getPdo();

if (!isset($_REQUEST["submit"])) {
    echo "<div style='margin: auto; width: 350px; text-align: right;'>";
    echo "
<form action='book.php' method='post'>
<strong>Last name</strong> <input type='text' name='apellidos' placeholder='Apellidos'> <br>
<strong> Name</strong> <input type='text' name='nombres' placeholder='Nombre'> <br>
<strong>Pitch type</strong> <select name='tipo'>";
    if (isset($_REQUEST["pitch"])) {
        $stmt = $con->prepare("SELECT * FROM types t join pitches p on p.type = t.id where p.number = :pitch");
        $pitch = htmlspecialchars($_REQUEST["pitch"]);
        $stmt->bindParam(':pitch', $pitch);
        $stmt->execute();
        $pitchType = $stmt->fetch();
        echo "<option value='" . $pitchType->id . "'>" . $pitchType->name . "</option>";

        echo "</select><br><br><input type='hidden' name='pitch' value='$pitch'>";
    } else {
        $stmt = $con->prepare("SELECT * FROM types");
        $stmt->execute();
        $types = $stmt->fetchAll();
        foreach ($types as $type) {
            echo "<option value='$type->id'>$type->name</option>";
        }
        echo "</select><br><br>";
    }
    echo "
<strong>Arrival</strong> <input type='date' name='arrivalDate'> 
<p>Date of arrival at the campsite</p>
<strong>Departure</strong> <input type='date' name='departureDate'>
<p>Date of departure at the campsite</p> 

<br><input type='submit' name='submit' value='Submit'>
</form><a href='index.php'><button>Home</button></a>";
}elseif (isset($_REQUEST["submitValue"])) {

    $type = htmlspecialchars($_REQUEST["tipo"]);
    $nombre = htmlspecialchars($_REQUEST["nombre"]);
    $apellidos = htmlspecialchars($_REQUEST["apellido"]);
    $arrivalDate = htmlspecialchars($_REQUEST["llegada"]);
    $departureDate = htmlspecialchars($_REQUEST["departure"]);

    echo "Succesfull reservation";
    echo $apellidos. " " . $nombre ."<br>";
    echo "arrival date " . $arrivalDate ."<br>";
    echo "departure date " . $departureDate ."<br>";
    echo "<a href='index.php'><button>Home</button></a>";
}
else{
    echo "<div style='margin: auto; width: 500px;'>";
    $type = htmlspecialchars($_REQUEST["tipo"]);
    $nombre = htmlspecialchars($_REQUEST["nombres"]);
    $apellidos = htmlspecialchars($_REQUEST["apellidos"]);
    $arrivalDate = htmlspecialchars($_REQUEST["arrivalDate"]);
    $departureDate = htmlspecialchars($_REQUEST["departureDate"]);
    echo "<table>";
    echo "<tr>";
    echo "<th>Number</th>";
    echo "<th>Electricity</th>";
    echo "</tr>";
    if(isset($_REQUEST["pitch"])){
        $pitch = htmlspecialchars($_REQUEST["pitch"]);
        $stmt = $con->prepare("SELECT * FROM rates t join pitches p on p.type = t.type where p.number = :pitch");
        $stmt->bindParam(':pitch', $pitch);
        $stmt->execute();
        $pitchType = $stmt->fetchAll();
        var_dump($stmt->rowCount());
    }else{

        $stmt = $con->prepare("SELECT * FROM types t join pitches p on p.type = t.id where t.id = :pitch");
        $stmt->bindParam(':pitch', $type);
        $stmt->execute();
        $datas = $stmt->fetchAll();
        $stmt = $con->prepare("SELECT * FROM electricity");
        $stmt->execute();
        $electricity = $stmt->fetchAll();
        echo "<form action='book.php' method='post'>";
        foreach ($datas as $data) {
            echo "<tr>
                <td>$data->number</td>
                <td>
                <select id='electricity'>";
                foreach ($electricity as $elect) {
                    echo "<option value='$elect->price'>$elect->ampere amperes</option>";
                }
            echo "</select>
                <input type='hidden' name='submit' value='submit'>
                <input type='hidden' name='tipo' value='$type'>
                <input type='hidden' name='nombre' value='$nombre'> 
                <input type='hidden' name='apellido' value='$apellidos'>
                <input type='hidden' name='llegada' value='$arrivalDate'>
                <input type='hidden' name='departure' value='$departureDate'>
                <input type='hidden' name='pitch' value='$data->number'>
                <input type='submit' name='submitValue' value='Submit'>
                </td>
                </tr>";
        }
        echo "</form>";
    }


    echo "</table>";


}
echo "</div>";
?>
</body>
</html>
