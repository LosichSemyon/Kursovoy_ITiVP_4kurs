<?php
// Подключение к базе данных
require_once('database_config.php');
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Получение фильтра, если предоставлен
$filter = $_POST['filter'] ?? '';

// SQL-запрос для получения данных о машинах с применением фильтра
$sql = "SELECT * FROM cars";

// Добавление условия WHERE только при наличии фильтра
if (!empty($filter)) {
    $sql .= " WHERE brand LIKE '%$filter%' OR license_plate LIKE '%$filter%' OR color LIKE '%$filter%' OR vin_number LIKE '%$filter%' OR username LIKE '%$filter%'";
}

$sql .= " ORDER BY year";

$result = $conn->query($sql);

// Вывод данных о машинах
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['brand'] . "</td>";
        echo "<td>" . $row['license_plate'] . "</td>";
        echo "<td>" . $row['color'] . "</td>";
        echo "<td>" . $row['year'] . "</td>";
        echo "<td>" . $row['vin_number'] . "</td>";
        echo "<td><button class='delete-button' onclick='deleteCar(\"" . $row['vin_number'] . "\")'>Удалить</button></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7'>Нет доступных данных</td></tr>";
}

$conn->close();
?>
