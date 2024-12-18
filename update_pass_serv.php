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
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];
    $username = $_POST["username"];

    // Проверка совпадения нового пароля и его подтверждения
    if ($newPassword !== $confirmPassword) {
        echo "<script>alert('Новые пароли не совпадают. Попробуйте еще раз.');</script>";
        exit;
    }

    // Проверка совпадения введенного старого пароля с паролем в базе данных
    $checkQuery = "SELECT password FROM users WHERE username='$username'";
    $result = $conn->query($checkQuery);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];

        if (password_verify($oldPassword, $hashedPassword)) {
            // Обновление пароля
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateQuery = "UPDATE users SET password='$hashedNewPassword' WHERE username='$username'";

            if ($conn->query($updateQuery) === TRUE) {
                echo "<script>alert('Пароль успешно обновлен.'); window.location.href = 'index.php';</script>";
                exit;
            } else {
                echo "<script>alert('Произошла ошибка при обновлении пароля.') window.location.href = 'index.php';</script>";
                exit;
            }
        } else {
            echo "<script>alert('Введен неверный старый пароль.'); window.location.href = 'index.php';</script>";
            exit;
        }
    } else {
        echo "<script>alert('Пользователь не найден в базе данных. Свяжитеь с разработчиками.'); window.location.href = 'index.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('Неверный метод запроса. Ну тут хз..'); window.location.href = 'index.php';</script>";
    exit;
}
?>
