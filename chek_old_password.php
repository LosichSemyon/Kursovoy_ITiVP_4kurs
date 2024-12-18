<?php
// Подключение к базе данных (замените значения переменных на ваши)
require_once('database_config.php');
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Проверка, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldPassword = $_POST["old_password"];
    $username = $_POST["username"]; // Получаем имя пользователя из формы

    // Проверка совпадения введенного старого пароля с паролем в базе данных
    $checkQuery = "SELECT password FROM users WHERE username='$username'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];

        if (password_verify($oldPassword, $hashedPassword)) {
            // Верный старый пароль
            $response = array("success" => true);
        } else {
            // Неверный старый пароль
            $response = array("success" => false);
        }
    } else {
        // Пользователь не найден в базе данных
        $response = array("success" => false);
    }

    // Возвращаем ответ в формате JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
