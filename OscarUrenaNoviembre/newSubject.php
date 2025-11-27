<?php
require "Subject.php";
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
if(isset($_SESSION["user"])){
    if(isset($_REQUEST["submit"])){
        $name = $_REQUEST["name"];
        $hours = $_REQUEST["hours"];
        $year = $_REQUEST["year"];
        if(!isset($_SESSION["user"]["subjects"])){

            $_SESSION["user"] += ["subjects" => []];
        }
        array_push($_SESSION["user"]["subjects"], new \OscarUrenaNoviembre\Subject($name,$hours,$year));
        header("Location: index.php");
    }else{
        echo "<form action='newSubject.php' method='post'>";
        echo "<br> Name: <input type='text' name='name' placeholder='Name' required>";
        echo "<br> Hours: <input type='number' name='hours' placeholder='Hours' required>";
        echo "<br> Year: <select name='year'>";
        echo "<option value='1'>1</option>";
        echo "<option value='2'>2</option>";
        echo "</select><br>";
        echo "<br> <input type='submit' name='submit' value='Submit'>";
        echo "<a href='index.php'><button name='reset'>Cancel</button></a>";
    }
}else{
    header("Location: index.php");
}
?>
</body>
</html>
