<?php
// Подключение к базе данных
require_once('database_config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение данных из формы авторизации
$username = $_POST['username'];
$password = $_POST['password'];

// SQL запрос для выборки пользователя из таблицы users
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);
$response = array();

if ($result->num_rows > 0) {
    // Пользователь найден, проверяем пароль
    $row = $result->fetch_assoc();
    if (password_verify($password, $row['password'])) {
        // Получение роли пользователя из таблицы roles
        $sqlRole = "SELECT role FROM roles WHERE username='$username'";
        $resultRole = $conn->query($sqlRole);
        if ($resultRole->num_rows > 0) {
            $rowRole = $resultRole->fetch_assoc();
            $response['success'] = "Авторизация успешна";
            $response['username'] = $username; // Включаем имя пользователя в ответ
            $response['role'] = $rowRole['role']; // Включаем роль пользователя в ответ
        } else {
            $response['role_error'] = "Роль пользователя не найдена";
        }
    } else {
        $response['password_error'] = "Неверный пароль";
    }
} else {
    $response['username_error'] = "Пользователь не найден";
}

echo json_encode($response);

$conn->close();
?>