<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>История заказов</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .clear-button {
            margin-top: 10px;
            padding: 8px;
            background-color: #ff0000;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h2>История заказов</h2>

    <?php
    // Подключение к базе данных (замените значения переменных на ваши)
    require_once('database_config.php');
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка подключения
    if ($conn->connect_error) {
        die("Ошибка подключения к базе данных: " . $conn->connect_error);
    }

    // Запрос на получение истории заказов
    $query = "SELECT * FROM history_repairs";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr>
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

        echo "</table>";
    } else {
        echo "Нет данных для отображения.";
    }

    // Закрываем соединение
    $conn->close();
    ?>

    <button class="clear-button" onclick="clearReports()">Сжечь отчеты</button>

    <script>
        function clearReports() {
            if (confirm("Вы уверены, что хотите удалить все отчеты?")) {
                // AJAX-запрос на сервер для удаления отчетов
                var xhr = new XMLHttpRequest();
                xhr.open("GET", "clear_reports.php", true);

                xhr.onreadystatechange = function () {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Обработка ответа, если необходимо
                        location.reload(); // Перезагрузка страницы после удаления отчетов
                    }
                };

                xhr.send();
            }
        }
    </script>
</body>

</html>
