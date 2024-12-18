<?php
// Подключение к базе данных (замените значения переменных на ваши)
require_once('database_config.php');
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Запрос на удаление всех отчетов
$deleteQuery = "DELETE FROM history_repairs";
$result = $conn->query($deleteQuery);

if ($result) {
    echo "Отчеты успешно удалены.";
} else {
    echo "Произошла ошибка при удалении отчетов: " . $conn->error;
}

// Закрываем соединение
$conn->close();
?>
