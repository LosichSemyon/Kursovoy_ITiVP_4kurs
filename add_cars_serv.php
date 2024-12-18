<?php
// Подключение к базе данных MySQL
require_once('database_config.php');
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Получение данных из POST-запроса
$data = json_decode(file_get_contents('php://input'), true);

// Получение значений полей из данных
$username = $data['username'];
$brand = $data['brand'];
$licensePlate = $data['license_plate'];
$color = $data['color'];
$year = $data['year'];
$vinNumber = $data['vin_number'];

// Подготовка и выполнение SQL-запроса для добавления автомобиля
$stmt = $conn->prepare("INSERT INTO cars (username, brand, license_plate, color, year, vin_number) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssis", $username, $brand, $licensePlate, $color, $year, $vinNumber);

if ($stmt->execute()) {
    // Успешно добавлено
    $response = [
        'status' => 'success',
        'message' => 'Автомобиль успешно добавлен в базу данных.'
    ];
} else {
    // Ошибка при добавлении
    $response = [
        'status' => 'error',
        'message' => 'Ошибка при добавлении автомобиля в базу данных.'
    ];
}

$stmt->close();
$conn->close();

// Возвращение ответа клиенту
header('Content-Type: application/json');
echo json_encode($response);
?>