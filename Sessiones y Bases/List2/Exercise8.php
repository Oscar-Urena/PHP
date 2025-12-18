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
echo ("
    <form action='Exercise8.php' method='POST'>
    <label for='video'>
        <input type='text' name='video'>
        <input type='submit' value='video'>
    </label>
    </form>
    <br>
");
$video = "";
if(isset($_POST["video"])){
    $video = $_POST["video"];
    $video = substr_replace($video, "embed/", strpos($video, "watch?v="), strlen("watch?v="));
    echo ("<iframe width='560' height='315' src=" . $video . " title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin' allowfullscreen></iframe>");

}
?>

</body>
</html>