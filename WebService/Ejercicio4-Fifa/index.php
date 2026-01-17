<?php

    $apikey = "";


    $ch = curl_init();

    curl_setopt_array($ch, [
        CURLOPT_URL => '',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => [
            'Authorization: Bearer ' . $apikey,
            'Accept: application/json',
        ]
    ]);

    $response = curl_exec($ch);

    if(curl_errno($ch)){
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);

    echo $response;
    
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

</body>
</html>
