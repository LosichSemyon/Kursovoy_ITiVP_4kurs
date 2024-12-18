<?php
// Подключение к базе данных
require_once('database_config.php');

// SQL-запрос для объединения данных о пользователях и ролях
$sql = "SELECT users.username, roles.role FROM users LEFT JOIN roles ON users.username = roles.username";
$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Вывод данных в формате JSON
echo json_encode($data);

// Закрытие соединения с базой данных
$conn->close();
?>
