<?php
// get_current_repairs.php

// Подключение к базе данных (замените значения переменных на ваши)
require_once('database_config.php');
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Получение имени пользователя из GET-параметра
$username = $_GET['username'];

// Запрос на получение текущих ремонтов для менеджера
$query = "SELECT * FROM current_repairs WHERE client_name='$username'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
  echo  "<tr>
    <th>ID Ремонта</th>
    <th>Механик</th>
    <th>Менеджер</th>
    <th>Клиент</th>
    <th>Марка авто</th>
    <th>VIN-номер</th>
    <th>Дата начала</th>
    <th>Дата завершения</th>
    <th>Стоимость</th>
    <th>Статус</th>
</tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id_repair']}</td>
                <td>{$row['mech_name']}</td>
                <td>{$row['manager_name']}</td>
                <td>{$row['client_name']}</td>
                <td>{$row['car_brand']}</td>
                <td>{$row['vin_number']}</td>
                <td>{$row['start_date']}</td>
                <td>{$row['finish_date']}</td>
                <td>{$row['cost']}</td>
                <td>{$row['status']}</td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='10'>Нет текущих ремонтов для отображения.</td></tr>";
}

// Закрываем соединение
$conn->close();
?>
