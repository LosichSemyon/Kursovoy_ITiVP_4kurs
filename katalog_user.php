<!DOCTYPE html>
<html>
<head>
    <title>Каталог деталей</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }

        .button {
  background-color: yellow;
  color: #000;
  border: 2px solid #000;
  border-radius: 5px;
  padding: 10px 20px;
  margin: 10px;
  cursor: pointer;
}

button:hover {
  background-color: #ccc;
}
    </style>
</head>
<body>
    <h1>Каталог деталей</h1>
    <form method="GET" action="">
        <label for="search_name">Поиск по названию:</label>
        <input type="text" id="search_name" name="search_name">
        <input class="button" type="submit" value="Поиск по названию">
    </form>
    <form method="GET" action="">
        <label for="search_sku">Поиск по артикулу:</label>
        <input type="text" id="search_sku" name="search_sku">
        <input class="button" type="submit" value="Поиск по артикулу">
    </form>
    <form method="GET" action="">
        <input type="hidden" name="show_all" value="1">
        <input class="button" type="submit" value="Отобразить все">
    </form>
    <form method="GET" action="">
        <input type="hidden" name="search_name" value="<?php echo $_GET['search_name'] ?? ''; ?>">
        <input type="hidden" name="search_sku" value="<?php echo $_GET['search_sku'] ?? ''; ?>">
        <label for="sort">Сортировка по цене:</label>
        <select id="sort" name="sort">
            <option value="asc">По возрастанию</option>
            <option value="desc">По убыванию</option>
        </select>
        <input class="button" type="submit" value="Сортировать">
    </form>

    <?php
        // Подключение к базе данных
        require_once 'database_config.php';
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Обработка поиска
        $search_name = $_GET['search_name'] ?? '';
        $search_sku = $_GET['search_sku'] ?? '';

        // Построение SQL-запроса поиска
        $sql = "SELECT * FROM car_parts";
        if (!empty($search_name)) {
            $sql .= " WHERE part_name LIKE '%$search_name%'";
        } elseif (!empty($search_sku)) {
            $sql .= " WHERE part_sku LIKE '%$search_sku%'";
        }
        $search_result = $conn->query($sql);
        if (!$search_result) {
            echo "Ошибка при выполнении запроса: " . $conn->error;
            exit;
        }

        // Применение сортировки к результатам поиска
        $sort = $_GET['sort'] ?? 'asc'; // По умолчанию сортировка по возрастанию
        $sorted_result = [];
        if ($search_result->num_rows > 0) {
            while ($row = $search_result->fetch_assoc()) {
                $sorted_result[] = $row;
            }
            // Сортировка
            if ($sort === 'desc') {
                usort($sorted_result, function ($a, $b) {
                    return $b['part_price'] - $a['part_price'];
                });
            } else {
                usort($sorted_result, function ($a, $b) {
                    return $a['part_price'] - $b['part_price'];
                });
            }

            // Вывод таблицы отсортированных результатов поиска
            echo "<table>";
            echo "<tr><th>Артикул</th><th>Название</th><th>Описание</th><th>Цена</th><th>Остаток</th></tr>";
            foreach ($sorted_result as $row) {
                echo "<tr>";
                echo "<td>" . $row['part_sku'] . "</td>";
                echo "<td>" . $row['part_name'] . "</td>";
                echo "<td>" . $row['part_description'] . "</td>";
                echo "<td>" . $row['part_price'] . "</td>";
                echo "<td>" . $row['part_stock'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "Нет доступных деталей.";
        }

        $conn->close();
    ?>
</body>
</html>