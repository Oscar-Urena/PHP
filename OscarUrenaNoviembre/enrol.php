<?php

use OscarUrenaNoviembre\Student;

require "Student.php";
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
if(isset($_SESSION['user'])){
    if(isset($_REQUEST["submited"])){
        $student = $_REQUEST["student"];
        $subject = $_REQUEST["subject"];
        foreach($_SESSION["user"]["students"] as $students){
            if($students->getLastName() === $student){
                if($students->addSubject($subject) == -1)
                    echo "You cant enroll more than one thousand hour, and you tried to enroll {$subject->getHours()} hours.}";
                else{
                }
            }
        }
        echo "<a href='index.php'>Volver al menu</a>";
    }else{
        echo "<form action='enrol.php' method='post'>";
        echo "<br> Student <select name='student' required>";
        foreach($_SESSION["user"]["students"] as $student){
            echo "<option value='".$student->getLastName()."'>". $student->getFirstName() . " " . $student->getLastName()."</option>";
        }
        echo "</select>";
        echo "<br> Subject <select name='subject' required>";
        foreach($_SESSION["user"]["subjects"] as $subject){
            echo "<option value='".$subject."'>". $subject->getName(). "</option>";
        }
        echo "</select>";
        echo "<br> <input type='submit' name='submited' value='Enrol'>";
        echo "</form>";

    }
}else{
    header("location: index.php");
}
?>

</body>
</html>
