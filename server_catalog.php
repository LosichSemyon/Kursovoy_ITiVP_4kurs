<?php
// Подключение к базе данных
require_once('database_config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения с базой данных
if ($conn->connect_error) {
    die("Ошибка подключения к базе данных: " . $conn->connect_error);
}

// Переменная для хранения названия столбца для сортировки
$sortColumn = isset($_GET['sortColumn']) ? $_GET['sortColumn'] : 'part_id';
// Переменная для хранения порядка сортировки (ASC или DESC)
$sortOrder = isset($_GET['sortOrder']) && strtoupper($_GET['sortOrder']) === 'DESC' ? 'DESC' : 'ASC';

// Переменные для поиска по артикулу и названию
$searchSku = isset($_GET['searchSku']) ? $_GET['searchSku'] : '';
$searchName = isset($_GET['searchName']) ? $_GET['searchName'] : '';

// SQL-запрос для получения данных о запчастях с учетом сортировки и поиска
$sql = "SELECT * FROM car_parts 
        WHERE part_sku LIKE '%$searchSku%' 
        AND part_name LIKE '%$searchName%'
        ORDER BY $sortColumn $sortOrder";

$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Вывод данных в формате HTML
foreach ($data as $row) {
    echo "<tr>";
    echo "<td>" . $row["part_id"] . "</td>";
    echo "<td>" . $row["part_sku"] . "</td>";
    echo "<td>" . $row["part_name"] . "</td>";
    echo "<td>" . $row["part_description"] . "</td>";
    echo "<td>" . $row["part_price"] . "</td>";
    echo "<td>" . $row["part_stock"] . "</td>";
    echo "<td>
              <button class='delete-button' onclick='deletePart(" . $row["part_id"] . ")'>Удалить</button>
              <button class='edit-button' onclick='editPart(" . $row["part_id"] . ")'>Редактировать</button>
          </td>";
    echo "</tr>";
}

// Закрытие соединения с базой данных
$conn->close();
?>
