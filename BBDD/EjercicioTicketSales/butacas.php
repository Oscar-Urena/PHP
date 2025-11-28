<?php
    session_start();
    require_once "Conexion.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .butaca{
            padding: 2px 5px;
        }
    </style>
</head>
<body>
<?php
if(isset($_REQUEST["session"])){
    $teatro = $_SESSION["teatro"];
    $sesion = $_REQUEST["session"];
    $con = (new Connection())->getPdo();
    $stmt = $con->prepare("SELECT * FROM teatros where idTeatro = :teatro");
    $stmt->bindParam(':teatro', $teatro);
    $stmt->execute();
    $teatros = $stmt->fetchAll();
    echo "<h2>{$teatros[0]->teatro}</h2>";
    $stmt = $con->prepare("SELECT count(*) as total FROM entradas where idSesion = :sesion and fila = :fila and columna = :columna");
    $stmt->bindParam(':sesion', $sesion);
    for($i=1; $i<$teatros[0]->filas; $i++){
        $stmt->bindParam(':fila', $i);
        for($j=1; $j<$teatros[0]->columnas; $j++){
            $stmt->bindParam(':columna', $j);
            $stmt->execute();
            $cuenta = $stmt->fetch();
            if($cuenta->total != 0){
                echo "<img class='butaca' src='./img/ocupada.gif'>";

            }else{
                echo "<img class='butaca' onclick='seleccionar(this)' id='{$i}-{$j}' src='./img/libre.gif'>";
            }
        }
        echo "<br>";
    }


    echo "<a href='index.php?sala={$_SESSION['teatro']}'><button type='button'>Cancelar</button></a>";
    // echo "<a href='butacas.php?venta=1'><button type='button' onclick='comprarEntradas(this)' id='aceptar' disabled>Aceptar</button></a>";
    echo "<button type='button' onclick='comprarEntradas(event)' id='aceptar' disabled>Aceptar</button>";

}else{
    header("location:index.php");
}
?>
<script>
    function seleccionar(elemento){
        if(elemento.src.includes("libre")){
            elemento.src = "./img/reservada.gif";
            elemento.classList.add("reservada");
        }else{
            elemento.src = "./img/libre.gif";
            elemento.classList.remove("reservada");
        }
        console.log(elemento.id);
        const butacas = document.querySelectorAll(".reservada");
        const boton = document.querySelector("#aceptar");
        if(butacas.length > 0){
            boton.disabled = false;
        }else{
            boton.disabled = true;
        }
    }
    function comprarEntradas(e){
        e.preventDefault();
        const butacas = document.querySelectorAll(".reservada");
        const filas =[];
        const columnas =[];

        butacas.forEach(butaca => {
            const fila = butaca.id.split("-")[0];
            const columna = butaca.id.split("-")[1];

            filas.push(fila);
            columnas.push(columna);
        });
        for (i = 0; i<filas.length; i++){
            console.log("Fila:", filas[i], " Columna:", columnas[i]);
        }
    }
</script>
</body>
</html>
