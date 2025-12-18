<?php
require "conexion.php";
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
    <link rel="stylesheet" href="./styles.css">
</head>
<body>
<?php
$con = (new Connection())->getPdo();
if(isset($_REQUEST['submit'])){
    $stmt3 = $con->prepare("UPDATE students SET name = :nombre, surname = :surname, course_id= :course WHERE id = :id");
    $stmt3->bindParam(':nombre', $_REQUEST['firstName']);
    $stmt3->bindParam(':surname', $_REQUEST['lastName']);

    $stmt3->bindParam(':course', $_REQUEST['course']);
    $stmt3->bindParam(':id', $_REQUEST['student']);
    $stmt3->execute();
    echo "
    <script>
    alert('Alumno editado');
    </script>
    ";
}

$stmt = $con->prepare("SELECT * FROM students WHERE id = :id");
$stmt->bindParam(":id", $_REQUEST["student"]);
$stmt->execute();
$student = $stmt->fetch();
$stmt2 = $con->prepare("SELECT * FROM courses");
$stmt2->execute();
$courses = $stmt2->fetchAll();
echo "<h2>Updating</h2>";
echo "<div id='actualizar'>";
echo "<form class='actualizar' action='update.php?student={$student->id}' method='POST'>";
echo "<label>First Name </label>";
echo "<input type='text' name='firstName' value='" . $student->name . "'><br>";
echo "<label>Last Name </label>";
echo "<input type='text' name='lastName' value='" . $student->surname . "'><br>";
echo "<label>Course </label>";
echo "<input type='hidden' name='id' value='{$_REQUEST['student']}'>";
echo "<select name='course'>";
foreach ($courses as $course) {
    if($course->id == $student->course_id){
        echo "<option value='" . $course->id . "' selected>" . $course->description . "</option>";
    }
    else{
        echo "<option value='" . $course->id . "'>" . $course->description . "</option>";
    }
}
echo "</select><br>";
echo "<input type='submit' name='submit' value='Update'><br>";
echo "<a href='index.php'>Volver a la lista</a>";
echo "</div>";
?>
</body>
</html>
