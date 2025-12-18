<?php
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
    if(isset($_SESSION["user"])){
        if(isset($_REQUEST["students"])){
            echo "<h1>List of Students</h1>";
            if(!isset($_SESSION["user"]["students"])){
                echo "<p>No students introduced yet</p>";
            }else{
                foreach($_SESSION["user"]["students"] as $student){
                    echo $student->getLastName() . " list.php" . $student->getFirstName() . " " . $student->getYear();
                    $clases = $student->getSubjects();
                    if(sizeof($clases) == 0){
                        echo "<p>No classes introduced yet</p>";
                    }
                    else{
                        echo "<ul>";
                        foreach($clases as $clase){
                            echo "<li>".$clase."</li>";
                        }
                        echo "</ul>";
                    }
                }
            }
        }
        else{
            echo "<h1>List of Subjects</h1>";
            if(!isset($_SESSION["user"]["subjects"])){
                echo "<p>No subjects introduced yet</p>";
            }else{
                foreach($_SESSION["user"]["subjects"] as $subject){
                    echo "<p>".$subject."</p>";
                    echo "<ul>";
                    foreach($_SESSION["user"]["students"] as $student){
                        foreach ($student->getSubjects() as $subject) {
                            if($subject == $subject){
                                echo "<li>".$student."</li>";
                            }
                        }
                    }
                    echo "</ul>";
                }
            }
        }
        echo "<a href='index.php'>Home page</a>";
    }
    else{
        header("Location: index.php");
    }
?>
</body>
</html>
