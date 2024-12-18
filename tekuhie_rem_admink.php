<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Текущие ремонты</title>
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
    </style>
</head>

<body>
    <h2>Текущие ремонты</h2>
    <?php
    // Подключение к базе данных (замените значения переменных на ваши)
    //<button onclick="window.location.href='analitica_admin.php'">анализировать</button>
    require_once('database_config.php');
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка подключения
    if ($conn->connect_error) {
        die("Ошибка подключения к базе данных: " . $conn->connect_error);
    }

    // Запрос на получение текущих ремонтов
    $query = "SELECT * FROM current_repairs";
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
            $statusColor = getStatusColor($row['status']);

            echo "<tr style='background-color: $statusColor;'>
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

    // Функция для получения цвета в зависимости от статуса
    function getStatusColor($status) {
        switch ($status) {
            case 0:
                return 'rgba(0, 0, 255, 0.5)'; // Прозрачный синий
            case 1:
                return 'rgba(255, 255, 0, 0.5)'; // Прозрачный желтый
            case 2:
                return 'rgba(255, 165, 0, 0.5)'; // Прозрачный оранжевый
            case 3:
                return 'rgba(0, 128, 0, 0.5)'; // Прозрачный зеленый
            default:
                return 'transparent';
        }
    }
    ?>
</body>

</html>
