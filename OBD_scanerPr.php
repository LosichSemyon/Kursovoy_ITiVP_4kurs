<?php
// Подключение к базе данных
require_once 'database_config.php';

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die('Ошибка подключения к базе данных: ' . $conn->connect_error);
}

// Получение списка ошибок из базы данных
$sql = 'SELECT error_code, error_name, error_description FROM car_errors';
$result = $conn->query($sql);

$errors = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $errors[] = $row;
    }
}

// Закрытие соединения с базой данных
$conn->close();

// Возвращение списка ошибок в формате JSON
header('Content-Type: application/json');
echo json_encode($errors);
?>