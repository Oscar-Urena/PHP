<?php

session_start();

use Exercise2\Client;
use Exercise2\Current;
use Exercise2\Savings;

require "./Client.php";
require "./Current.php";
require "./Savings.php";
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

if(isset($_REQUEST['user'])){
    echo "<form method='POST' action=''>";
    echo "<input type='text' name='name' value='name'>";
    echo "<input type='text' name='dni' value='dni'>";
    echo "<input type='submit' value='Enviar'>";
}else if(isset($_REQUEST['account'])){

}else if(isset($_REQUEST['depmoney'])){

}else if(isset($_REQUEST['withmoney'])){

}else if(isset($_REQUEST['viewacc'])){

}else if(isset($_REQUEST['calculate'])){

}else{
    echo "<a href='./index.php?user=1'>Add Client</a>";
    echo "<a href='./index.php?account=1'>Add Account</a>";
    echo "<a href='./index.php?depmoney=1'>Deposit money</a>";
    echo "<a href='./index.php?withmoney=1'>Withdraw money</a>";
    echo "<a href='./index.php?calculate=1'>Calculate interest</a>";
}


?>
</body>
</html>
