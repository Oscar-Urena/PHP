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
if (isset($_REQUEST['delete'])) {
    $stmt2 = $con->prepare("DELETE FROM students WHERE id = :id");
    $stmt2->bindParam(':id', $_REQUEST['delete']);
    $stmt2->execute();
    echo "
    <script>
    alert('Registro eliminado');
    </script>
    ";
}
$stmt = $con->prepare("SELECT * FROM students");
$stmt->execute();
$students = $stmt->fetchAll();

echo "<table class='tablaAlumno'>";
echo "<tr class='tablaAlumnoTr'>";
echo "<th>First Name</th>";
echo "<th>Last Name</th>";
echo "<th>Course</th>";
echo "<th colspan='2'>Actions</th>";
echo "</tr>";
$stmt2 = $con->prepare("SELECT description FROM courses where id= :course");
foreach ($students as $student) {
    echo "<tr>";
    echo "<td>$student->name</td>";
    echo "<td>$student->surname</td>";
    $stmt2->bindParam(':course', $student->course_id);
    $stmt2->execute();
    $course = $stmt2->fetch();
    echo "<td>$course->description</td>";
    echo "<td><a href='index.php?delete={$student->id}'>Delete</a></td>";
    echo "<td><a href='update.php?student={$student->id}'>Update</a></td>";
}
echo "</table>";
?>
</body>
</html>
