<?php
session_start();
require 'vendor/autoload.php';
// reference the Dompdf namespace
use Dompdf\Dompdf;
// 1. Configuración de encabezados HTTP
// Esto es CRUCIAL para indicarle al navegador que el contenido es un PDF
// y que debe ser manejado "inline" (mostrado).
header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="prueba.pdf"');
header('Cache-Control: public, must-revalidate, max-age=0');
header('Pragma: public');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT'); // Fecha en el pasado

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml('hello world');

// (Optional) Set up the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// 2. Usar el modo "I" (Inline)
// El modo "I" (Inline) le dice a Dompdf que envíe la salida al navegador.
// ... después de $dompdf->render();

$dompdf->stream("prueba.pdf", array("Attachment" => false));
// PhpStorm reconocerá el array de opciones más fácilmente.
// "Attachment" => false es el equivalente moderno de usar "I".
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
<h1>Hola</h1>
</body>
</html>

