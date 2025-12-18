<?php
    session_start();
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
    $users = array("mperez" => "uno", "sfernandez" => "dos", "mluque" => "tres", "acalvo" => "cuatro");
    if(isset($_SESSION["user"])){
        echo "<a href='newStudents.php'>New Student</a><br>";
        echo "<a href='newSubject.php'>New Subject</a><br>";
        echo "<a href='enrol.php'>Enrol Student</a><br>";
        echo "<a href='list.php?students=1'>List by Students</a><br>";
        echo "<a href='list.php?subjects=1'>List by Subjects</a><br>";
    }else{
        if(isset($_REQUEST["submit"])){
            $nombre = $_REQUEST["nombre"];
            $password = $_REQUEST["password"];
            if($users[$nombre] == $password){
                $_SESSION["user"] = $nombre;
                header("location: index.php");
            }
            else{
                header("location: index.php?wrongPassword=1");
            }
        }else{
            echo "<h1>Welcome, Trassierra Educational Training</h1>";
            echo "<form method='post' action='index.php'>";
            echo "<input type='text' name='nombre' >";
            echo "<input type='text' name='password'>";
            echo "<input type='hidden' name='periquito' value='periquito'>";
            echo "<input type='submit' name='submit' value='Login'>";
            if(isset($_REQUEST["wrongPassword"])){
                echo "<p>Wrong Password</p>";
            }
            echo "</form>";
        }
    }
?>
</body>
</html>
