<?php
    session_start();
    require "Connection.php";
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
if(isset($_REQUEST["logout"])){
    session_destroy();
    header("Location: index.php");
}
if(isset($_REQUEST["submit"])){
    $username = htmlspecialchars($_REQUEST["usuario"]);
    $password = htmlspecialchars($_REQUEST["password"]);
    $con = (new Connection())->getPdo();
    $stmt = $con->prepare("SELECT * FROM users WHERE username = :name and password = :pass");
    $stmt->bindParam(':name', $username);
    $stmt->bindParam(':pass', $password);
    $stmt->execute();
    echo $stmt->rowCount();
    if($stmt->rowCount() > 0){
        $_SESSION["usuario"] = $username;
        header("Location: index.php");
    }else{
        header("Location: index.php?wrongCredentials=1");
    }

}elseif(isset($_SESSION["usuario"])){
    echo "<h2>Trassierra Campside</h2>";
    echo "<div><a href='book.php'>Book</a>  <a href='pitchesToday.php'>Pitches available today</a></div>";
    echo "usuario\"]}</p><a href=>Logout</a></div>";
}else{
    echo "
    <form action='index.php' method='POST'>
    <input type='text' name='usuario' placeholder='Usuario'>
    <input type='password' name='password' placeholder='Password'>
    <input type='submit' name='submit' value='Submit'>";
    if(isset($_REQUEST["wrongCredentials"])){
        echo "<span>Wrong credentials, try again.</span>";
    }
    echo "</form>
    ";
}
?>
</body>
</html>
