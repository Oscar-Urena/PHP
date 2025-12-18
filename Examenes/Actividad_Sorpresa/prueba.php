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
<form method="post">
    <INPUT TYPE="radio" NAME=“sexo" VALUE=“M“ CHECKED>Mujer
    <INPUT TYPE="radio" NAME=“sexo" VALUE=“H">Hombre
    <input type="submit">
</form>
<?PHP
$sexo = $_REQUEST['sexo'];
print ($sexo);
?>
</body>
</html>