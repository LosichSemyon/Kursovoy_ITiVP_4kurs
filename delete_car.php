<?php
// Получение параметра carId из POST-запроса
$carId = $_POST['carId'];

// Подключение к базе данных
require_once('database_config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения с базой данных
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Удаление записи из таблицы автомобилей
$sql = "DELETE FROM cars WHERE vin_number = '$carId'";

if ($conn->query($sql) === TRUE) {
    echo "Запись успешно удалена";
} else {
    echo "Ошибка при удалении записи: " . $conn->error;
}

// Закрытие соединения с базой данных
$conn->close();
?>
