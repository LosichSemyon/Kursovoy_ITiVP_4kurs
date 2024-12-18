<!-- get_confirmation_data.php -->

<?php
// Подключение к базе данных (замените на ваши реальные данные)
// Подключение к базе данных
require_once('database_config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение имени пользователя из URL
$username = $_GET['username'];

// Запрос на получение данных для формы
$sql = "SELECT id_remonta FROM текущие_ремонты WHERE status = 3 AND manager_name = '$username'";
$result = $conn->query($sql);

// Обработка результатов запроса
$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Закрытие подключения к базе данных
$conn->close();

// Отправка данных в формате JSON
echo json_encode($data);
?>

