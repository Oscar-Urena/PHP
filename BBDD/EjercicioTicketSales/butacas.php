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
        .chbutaca{
            display: none;
        }
    </style>
</head>
<body>
<?php
if(isset($_REQUEST["session"])){
    $con = (new Connection())->getPdo();
    if(isset($_REQUEST["seleccionadas"])){
        $butacas = $_REQUEST["seleccionadas"];
        $stmt = $con->prepare("INSERT INTO entradas (idSesion, fila, columna) VALUES (:session, :fila, :columna);");
        foreach ($butacas as $b) {
            $fila = explode("-", $b)[0];
            $columna = explode("-", $b)[1];
            $stmt->bindParam(':session', $_REQUEST["session"]);
            $stmt->bindParam(':fila', $fila);
            $stmt->bindParam(':columna', $columna);
            $stmt->execute();
        }
        header("Location: butacas.php?session={$_REQUEST['session']}");
    }elseif (isset($_REQUEST["comprado"])){

    }else{
        $teatro = $_SESSION["teatro"];
        $sesion = $_REQUEST["session"];

        $stmt = $con->prepare("SELECT * FROM teatros where idTeatro = :teatro");
        $stmt->bindParam(':teatro', $teatro);
        $stmt->execute();
        $teatros = $stmt->fetchAll();
        echo "<h2>{$teatros[0]->teatro}</h2>";
        $stmt = $con->prepare("SELECT count(*) as total FROM entradas where idSesion = :sesion and fila = :fila and columna = :columna");
        $stmt->bindParam(':sesion', $sesion);
        echo "<form action='butacas.php' method='post'>";
        for($i=1; $i<=$teatros[0]->filas; $i++){
            $stmt->bindParam(':fila', $i);
            for($j=1; $j<=$teatros[0]->columnas; $j++){
                $stmt->bindParam(':columna', $j);
                $stmt->execute();
                $cuenta = $stmt->fetch();
                if($cuenta->total != 0){
                    echo "<img class='butaca' src='./img/ocupada.gif'>";
                }else{
                    echo "<label for='{$i}-{$j}'><img class='butaca' onclick='seleccionar(this)' src='./img/libre.gif'></label>";
                    echo "<span class='chbutaca'><input type='checkbox' id='{$i}-{$j}' value='{$i}-{$j}' name='seleccionadas[]'></span>";
                }

            }
            echo "<br>";
        }
        echo "<a href='index.php?sala={$_SESSION['teatro']}'><button type='button'>Cancelar</button></a>";
        echo "<input type='hidden' name='session' value='{$_REQUEST['session']}'>";
        echo "<button type='submit' id='aceptar' disabled>Aceptar</button>";
        echo "</form>";
    }
}else{
    header("Location:index.php");
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
        const butacas = document.querySelectorAll(".reservada");
        const boton = document.querySelector("#aceptar");
        if(butacas.length > 0){
            boton.disabled = false;
        }else{
            boton.disabled = true;
        }
    }
    /*function comprarEntradas(e){
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
        const formulario = document.createElement("form");
        formulario.method = "POST";
        formulario.action = "butacas.php";
        const campo1 = document.createElement("input");
        campo1.type= "hidden";
        campo1.name= "filas[]";
        campo1.value = JSON.stringify(filas);
        formulario.append(campo1);
        const campo2 = document.createElement("input");
        campo2.type= "hidden";
        campo2.name= "columnas[]";
        campo2.value = JSON.stringify(columnas);
        formulario.append(campo2);
        document.body.append(formulario);
        formulario.submit();
    }*/
</script>
</body>
</html>
