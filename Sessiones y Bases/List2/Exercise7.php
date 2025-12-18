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
 $min = 1;
 $max = 100;
if(isset($_POST["submit"])){
    $adv = ($_POST["adv"]);
    $intento = ($_POST["intento"]);
    if($adv === $intento){
        echo ("
            <h1>Adivina el número [$min...$max]</h1>
            <h2>¡Enhorabuena! Has acertado. El número era el $adv</h2>
        ");
    }
    else{
        if($adv < $min){
            echo ("
            <h1>Adivina el número [$min...$max]</h1>
            <h2>El número es mayor, Inténtalo de nuevo</h2>
            <form action='Exercise7.php' method='post'>
            <input type='hidden' name='adv' value='$adv'>
            <input type='text' name='intento' required>
            <input type='submit' name='submit' value='Submit'>
            </form>
        ");
        }else{
            echo ("
            <h1>Adivina el número [$min...$max]</h1>
            <h2>El número es menor, Inténtalo de nuevo</h2>
            <form action='Exercise7.php' method='post'>
            <input type='hidden' name='adv' value='$adv'>
            <input type='text' name='intento' required>
            <input type='submit' name='submit' value='Submit'>
            </form>
        ");
        }
    }
}else{
    $adv = rand($min, $max);
    echo ("
        <h1>Adivina el número [$min...$max]</h1>
        <form action='Exercise7.php' method='post'>  
        <input type='hidden' name='adv' value='$adv'>
        <input type='text' name='intento' required>
        <input type='submit' name='submit' value='Submit'>
        </form>
    ");
}
?>
</body>
</html>
