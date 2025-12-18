<?php
header("Content-Tyle: application/json");

require_once "../classes/user.php";

switch ($_SERVER["REQUEST_METHOD"]) {
    case "GET":
        if (isset($_GET["id"])) {
            echo User::getUser(htmlspecialchars($_GET["id"]));
        } else {
            echo User::getUsers();
        }
        break;
    case "POST":
        $POST = json_decode(file_get_contents("php://input"), true);
        $user = new User(htmlspecialchars($_REQUEST["name"]), htmlspecialchars($_REQUEST["surname"]), htmlspecialchars($_REQUEST["birthday"]), htmlspecialchars($_REQUEST["country"]));
        //$user = new User($POST['name'], $POST['surname'], $POST['birthday'], $POST['country']);
        $user->create();
        $result["message"] = "Usuario creado" . json_decode($_REQUEST);
        echo json_encode($result);
        break;
    case "DELETE":
        echo User::deleteUser(htmlspecialchars($_GET["id"]));
        break;
        case "PUT":
            $PUT = json_decode(file_get_contents("php://input"), true);
            $user = new User($PUT['name'], $PUT['surname'], $PUT['birthday'], $PUT['country']);
            $id=htmlspecialchars($_GET["id"]);
            $user->update($id);
            break;
    default:
        echo "Error con el método.";
}