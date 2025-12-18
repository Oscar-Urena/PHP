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
if(isset($_REQUEST["submit"])) {
    if (isset($_COOKIE[$_REQUEST["user"]])) {
        if($_COOKIE["Ejercicio3"][$_REQUEST["user"]] == $_REQUEST["password"]) {
            echo 'Rigth password for alumno';
        }
        else{
            echo 'Wrong password for alumno';
        }


    } else {
        setcookie("Ejercicio3[{$_REQUEST["user"]}]",$_REQUEST["password"] , time() + (86400), "/");
        echo 'Password save for alumno
    <br> <a href="Exercise3.php">Exercise 3</a>';
    }
}else{
    echo '<form action="Exercise3.php" method="post">
    <input type="text" name="user" value="">
    <input type="text" name="password" value="">
    <input type="submit" name="submit" value="submit">
    </form>
        ';
}
?>

</body>
</html>