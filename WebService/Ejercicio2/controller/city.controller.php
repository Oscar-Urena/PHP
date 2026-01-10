<?php


use classes\City;

header("Content-Type: application/json");

require_once "../classes/City.php";

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        if (isset($_GET["id"])) {
            echo City::getCity($_GET["id"]);
        } else {
            echo City::getCities();
        }
        break;
    case "PUT":
        break;
    default:
        echo "Not a method";

}