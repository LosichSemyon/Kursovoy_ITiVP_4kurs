<?php
require_once('database_config.php');

$conn = new mysqli($servername, $username, $password, $dbname);
// Обработка username из URL
$username = "";
if (isset($_GET["username"])) {
    $username = $_GET["username"];
}



// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Запрос для получения доступных автомобилей относительно username
$sql_cars = "SELECT vin_number FROM cars WHERE username = '$username'";
$result_cars = $conn->query($sql_cars);

// Запрос для получения текущих ремонтов относительно username
$sql_repairs = "SELECT id_repair, vin_number FROM current_repairs WHERE client_name = '$username'";
$result_repairs = $conn->query($sql_repairs);

// Вывод результатов для автомобилей
if ($result_cars->num_rows > 0 || $result_repairs->num_rows > 0) {
    echo "<h2>Доступные автомобили и текущие ремонты для пользователя $username:</h2>";
    echo "<form action='obrabotka_avto_client.php' method='post'>";

    if ($result_cars->num_rows > 0) {
        echo "<label for='selectedCar'>Выберите автомобиль:</label>";
        echo "<select name='selectedCar' id='selectedCar' required>";

        while ($row = $result_cars->fetch_assoc()) {
            echo "<option value='" . $row["vin_number"] . "'>" . $row["vin_number"] . "</option>";
        }

        echo "</select>";
        echo "<br>";
    }

    if ($result_repairs->num_rows > 0) {
        echo "<label for='selectedRepair'>Выберите ремонт:</label>";
        echo "<select name='selectedRepair' id='selectedRepair' required>";

        while ($row = $result_repairs->fetch_assoc()) {
            // Заменяем символ "|" на пустую строку
            $idRepairValue = str_replace('|', '', $row["id_repair"]);
            echo "<option value='" . $idRepairValue . $row["vin_number"] . "'>Ремонт #" . $row["id_repair"] . " (" . $row["vin_number"] . ")</option>";
        }

        echo "</select>";
        echo "<br>";
    }

    echo "<input type='hidden' name='username' value='$username'>";
    echo "<input type='submit' name='submitSelection' value='Выбрать'>";
    echo "</form>";
} else {
    echo "Нет доступных автомобилей и текущих ремонтов для пользователя $username.";
}

// Закрытие соединения с базой данных
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Страница автомобилей</title>
    <style>
        /* styles.css */

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    color: #333;
}

form {
    margin-top: 20px;
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

select, input {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
    box-sizing: border-box;
}

button {
  background-color: yellow;
  color: #000;
  border: 2px solid #000;
  border-radius: 5px;
  padding: 10px 20px;
  margin: 10px;
  cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

ul {
    list-style-type: none;
    padding: 0;
}

ul li {
    margin-bottom: 8px;
}

        </style>
</head>
<body>
    <!-- username передается в URL -->
    <p>Информация для пользователя: <?php echo isset($username) ? $username : ''; ?></p>
</body>
</html>
