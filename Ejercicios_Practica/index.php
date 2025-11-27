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

// (isset($_REQUEST['name']) ? $_REQUEST['name'] : '')  Para el value
$varAlumno = 0;
if(!isset($_SESSION['students'])) {
    if (!isset($_REQUEST['studentName'])) {
        echo "<form method='post'>";
        echo "Name of the student: <input type='text' name='name'>";
        echo "<input type='submit' value='enviar' name='studentName'>";
        echo "</form>";
    } else if ($_REQUEST['name'] == "") {
        echo "<form method='post'>";
        echo "Name of the student: <input type='text' name='name'>";
        echo "<input type='submit' value='enviar' name='studentName'>";
        echo "</form>";
        echo "The student name can't be empty.";
    }
    if(isset($_REQUEST['name'])&& $_REQUEST['name'] != ""){
        $_SESSION['students'][$varAlumno] = $_REQUEST['name'];
        header("Location: index.php");
    }
}
else {
    $completo = false;
    $nombreAlumno = $_SESSION['students'][$varAlumno];
    if(isset($_REQUEST['studentGrades'])){
        if($_REQUEST['PHP'] != "" && $_REQUEST['javaScript'] != "" && $_REQUEST['english'] != ""){
            $completo = true;
        }
    }

    if (isset($_REQUEST['studentGrades']) && $completo == true) {

        echo "<b>{$nombreAlumno} has been evaluated. These are their marks:</b><br>";
        echo "<b>PHP:</b> {$_REQUEST['PHP']}<br>";
        echo "<b>JavaScript:</b> {$_REQUEST['javaScript']}<br>";
        echo "<b>English:</b> {$_REQUEST['english']}<br>";
        echo "<a href='index.php?newStudent=1'>AnotherStudent</a>";
    }
    else{
            echo "<p>Enter the marks for <b>$nombreAlumno</b></p>";
            echo "Mark Subjects";

            echo "<form method='post'>";


            echo "<br>";
            echo "PHP <select name='PHP'>";
            echo "<option value=' {$_REQUEST['PHP']} ' selected hidden='hidden'> " .
                (isset($_REQUEST['PHP']) ? $_REQUEST['PHP'] : 'Choose the mark...')
                . "</option>";

            for ($i = 10; $i >= 1; $i--) {
                echo "<option value='$i'>$i</option>";
            }
            echo "</select>";
            if (isset($_REQUEST['PHP']) && $_REQUEST['PHP'] == "") {
                echo "PHP needs a mark";
            }
            echo "<br><br>";

            echo "JavaScript <select name='javaScript'>";
            echo "<option value=' {$_REQUEST['javaScript']} ' selected hidden='hidden'> " .
                (isset($_REQUEST['javaScript']) ? $_REQUEST['javaScript'] : 'Choose the mark...')
                . "</option>";
            for ($i = 10; $i >= 1; $i--) {
                echo "<option value='$i'>$i</option>";
            }
            echo "</select>";
            if (isset($_REQUEST['javaScript']) && $_REQUEST['javaScript'] == "") {
                echo "JavaScript needs a mark";
            }
            echo "<br><br>";
            echo "English <select name='english'>";
            echo "<option value=' {$_REQUEST['english']} ' selected hidden='hidden'> " .
                (isset($_REQUEST['english']) ? $_REQUEST['english'] : 'Choose the mark...')
                . "</option>";
            for ($i = 10; $i >= 1; $i--) {
                echo "<option value='$i'>$i</option>";
            }
            echo "</select>";
            if (isset($_REQUEST['english']) && $_REQUEST['english'] == "") {
                echo "English needs a mark";
            }
            echo "<br><br>";
            echo "<input type='submit' name='studentGrades' value='Enviar'>";
            echo "</form>";

        }
}

?>
</body>
</html>