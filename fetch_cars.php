<?php
    // Подключение к базе данных
    require_once('database_config.php');
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Проверка подключения
    if ($conn->connect_error) {
        die("Ошибка подключения: " . $conn->connect_error);
    }

    $storedUsername = $_POST['username'] ?? '';

    // SQL-запрос для получения данных о машинах, относящихся к указанному username
    $sql = "SELECT * FROM cars WHERE username = '$storedUsername'";
    $result = $conn->query($sql);

    // Вывод данных о машинах
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['brand'] . "</td>";
            echo "<td>" . $row['license_plate'] . "</td>";
            echo "<td>" . $row['color'] . "</td>";
            echo "<td>" . $row['year'] . "</td>";
            echo "<td>" . $row['vin_number'] . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<p>Нет доступных автомобилей для пользователя $storedUsername.</p>";
    }

    $conn->close();
?>