<?php
require_once('database_config.php');
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

$mechanic = $_POST['mechanic'];
$client = $_POST['client'];
$manager = $_POST['username'];

$currentDate = date("Y-m-d");

$insertQuery = "INSERT INTO current_repairs (mech_name, manager_name, client_name, start_date, status) VALUES ('$mechanic','$manager', '$client', '$currentDate', 0)";

if ($conn->query($insertQuery) === TRUE) {
    header("Location: manager_dashboard.php");
    exit();
} else {
    echo "Произошла ошибка при создании ремонта: " . $conn->error;
}


$conn->close();
?>
