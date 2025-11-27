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
if(!isset($validado)){
    $validado = false;
}
if(isset($_REQUEST["submit"])) {
    if($_REQUEST["nombre"] !== "" && $_REQUEST["age"] !== "" && !empty($_REQUEST["asignaturas"])) {
        $validado = true;
    } else {
        $validado = false;
    }
}

if(!$validado){
    echo "
    <h1>Form test</h1>
    <form method='POST' action=''>
    Name: <input type='text' name='nombre' value=". (isset($_REQUEST['nombre']) ? $_REQUEST['nombre'] : '') .">";
    if(isset($_REQUEST["nombre"]) && $_REQUEST["nombre"] === ""){
        echo "Debes rellenar este campo";
    }
        echo "<br>
    Age: <select name='age'><br>";
    for($i=12; $i <= 18; $i++){
       echo "<option value='{$i}'>{$i}</option>";
    }
    echo "
    </select><br>Group: <br><input type='radio' name='grupo' value='A' " . (isset($_REQUEST['grupo']) && $_REQUEST['grupo'] == 'A' ? 'checked' : '')  ." > 3º ESO A
    <br><input type='radio' name='grupo' value='B' " . (isset($_REQUEST['grupo']) && $_REQUEST['grupo'] == 'B' ? 'checked' : '')  ." > 3º ESO B
    <br><input type='radio' name='grupo' value='C' " . (isset($_REQUEST['grupo']) && $_REQUEST['grupo'] == 'C' ? 'checked' : '')  ." > 3º ESO C
    
    <br>My favourite subjects
    <br><input type='checkbox' name='asignaturas[]' value='Math'>Math
    <br><input type='checkbox' name='asignaturas[]' value='English'>English
    <br><input type='checkbox' name='asignaturas[]' value='History'>History
    <br><input type='checkbox' name='asignaturas[]' value='Biology'>Biology
    <br><input type='checkbox' name='asignaturas[]' value='Spanish'>Spanish
    ";
    if(isset($_REQUEST["asignaturas"]) && empty($_REQUEST["asignaturas"])){
        echo "Debes seleccionar alguna asignatura";
    }
    echo "<br><input type='submit' name='submit' value='submit'>
    </form>";
}else{
    echo "
    <h2>Name: {$_REQUEST['nombre']}</h2>
    <h2>Age: {$_REQUEST['age']}</h2>
    <h2>Group: {$_REQUEST['grupo']}</h2>
    <h2>Favourite Subjects:";
    for($i=0;$i<count($_REQUEST['asignaturas']);$i++){
        echo $_REQUEST['asignaturas'][$i] . " ";
    }
    echo "<h2>Success: Everything is ok</h2>";
}
?>
</body>
</html>