<?php
// Подключение к базе данных
require_once('database_config.php');

// Получение параметра partId из POST-запроса
$partId = $_POST['partId'];

// Проверка наличия partId
if (!isset($partId)) {
    die("Отсутствует параметр partId");
}

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения с базой данных
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Удаление записи из таблицы запчастей
$sql = "DELETE FROM car_parts WHERE part_id = $partId";

if ($conn->query($sql) === TRUE) {
    echo "Запись успешно удалена";
} else {
    echo "Ошибка при удалении записи: " . $conn->error;
}

// Закрытие соединения с базой данных
$conn->close();
?>
