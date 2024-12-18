<?php
// Подключение к базе данных
require_once('database_config.php');

// Получение данных из POST-запроса
//$partId = $_GET['partId'];

$partId = $_POST['partId'];
$partName = $_POST['partName'];
$partDescription = $_POST['partDescription'];
$partPrice = $_POST['partPrice'];
$partStock = $_POST['partStock'];

// Проверка соединения с базой данных
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// SQL-запрос для обновления данных о запчасти
$sql = "UPDATE car_parts SET part_name = '$partName', part_description = '$partDescription', part_price = $partPrice, part_stock = $partStock WHERE part_id = $partId";

if ($conn->query($sql) === TRUE) {
    echo "Данные успешно обновлены";
} else {
    echo "Ошибка при обновлении данных: " . $conn->error;
}

// Закрытие соединения с базой данных
$conn->close();
?>
