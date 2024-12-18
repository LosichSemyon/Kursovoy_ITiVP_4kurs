<?php

require_once('database_config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных от клиента
$repair_id = $_POST['repair_id'];
$price = $_POST['price'];

// Установка текущей даты
$current_date = date("Y-m-d");

// Подготовка SQL-запроса
$sql = "UPDATE current_repairs SET cost = ?, finish_date = ?, status = 2 WHERE id_repair = ?";
$stmt = $conn->prepare($sql);

// Привязка параметров
$stmt->bind_param("dss", $price, $current_date, $repair_id);

// Выполнение запроса
if ($stmt->execute()) {
    $response = array("status" => "success", "message" => "Цена успешно записана.", "status_code" => 2);
} else {
    $response = array("status" => "error", "message" => "Ошибка при выполнении запроса: " . $stmt->error);
}

// Закрытие подключения и отправка ответа клиенту
$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
