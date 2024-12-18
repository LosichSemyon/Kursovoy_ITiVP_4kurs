<?php
require_once('uslugi_serv.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service_name = $_POST["service_name"];
    $description = $_POST["description"];
    $price = $_POST["price"];

    addService($service_name, $description, $price);

    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => "Invalid request method"]);
}
?>
