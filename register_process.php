<?php
require_once('database_config.php');
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

$response = array();

$sql_check_username = "SELECT * FROM users WHERE username = '$username'";
$result_check_username = $conn->query($sql_check_username);

$sql_check_email = "SELECT * FROM users WHERE email = '$email'";
$result_check_email = $conn->query($sql_check_email);

if ($result_check_username->num_rows > 0) {
    $response['username_error'] = "Такой логин уже используется.";
} elseif ($result_check_email->num_rows > 0) {
    $response['email_error'] = "Такая почта уже используется.";
} elseif ($password != $confirm_password) {
    $response['password_error'] = "Пароли не совпадают.";
} else {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        $response['success'] = "Пользователь зарегистрирован успешно";
    } else {
        $response['error'] = "Ошибка: " . $sql . "<br>" . $conn->error;
    }
}

echo json_encode($response);

$conn->close();
?>


