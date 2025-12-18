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
if(isset($_REQUEST['submit'])){
    $nombre = $_REQUEST['name'];
    $fecha = $_REQUEST['birthday'];
    $sistema = $_REQUEST['OSOption'];
    $futbol = isset($_REQUEST['football']);
    $genero = $_REQUEST['gender'];
    //$aficiones = isset($_REQUEST['aficiones']) ? $_REQUEST['aficiones'] : [];

    echo htmlspecialchars($nombre);
}else{?>
<form action="Exercise4.php" method="post">
    <label for="name">
        Nombre
        <input type="text" name="name">
    </label>
    <br><br>
    <label for="birthday">
        Birthday
        <input type="date" name="birthday">
    </label>
    <br><br>
    <label for="OSOption">
        Favourite Operating System
        <select name="OSOption">
            <option value="Linux">Linux</option>
            <option value="Windows">Windows</option>
            <option value="MacOS">MacOS</option>
        </select>
    </label>
    <br><br>
    <label for="football">
        Do you like football?
        <input name="football" type="checkbox">
    </label>
    <br><br>
    Genero
    <br>
    <label for="gender">
        Male
        <input type="radio" id="gender" name="gender" value="male">
    </label>
    <br>
    <label for="gender">
        Female
        <input type="radio" id="gender" name="gender" value="female">
    </label>
    <br><br>
    <label for="hobbies">
        Hobbies
        <textarea name="hobbies" id="hobbies" cols="30" rows="5"></textarea>
    </label>
    <br><br>
    <input type="submit" name="submit" id="submit" value="submit">
    <button type="reset">Reset</button>
</form>
<?php } ?>
</body>
</html>