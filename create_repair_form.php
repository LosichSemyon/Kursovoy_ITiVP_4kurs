<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Создание ремонта</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            width: 300px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        select,
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <script>
        // Получение имени пользователя из localStorage
        var username = localStorage.getItem("username");

        // Функция для установки значения в поле username перед отправкой формы
        function setUserName() {
            document.getElementById("username").value = username;
        }

        // Вызываем функцию при загрузке страницы
        window.onload = setUserName;
    </script>
    <form action="process_create_repair.php" method="post">
        <h2>Создание ремонта</h2>
        <label for="mechanic">Выберите механика:</label>
        <select id="mechanic" name="mechanic" required>
            <?php
            // Подключение к базе данных (замените значения переменных на ваши)
            require_once('database_config.php');
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Проверка подключения
            if ($conn->connect_error) {
                die("Ошибка подключения к базе данных: " . $conn->connect_error);
            }

            // Запрос на получение всех механиков из таблицы roles
            $mechanicQuery = "SELECT username FROM roles WHERE role='mekchanic'";
            $mechanicResult = $conn->query($mechanicQuery);

            if ($mechanicResult->num_rows > 0) {
                while ($row = $mechanicResult->fetch_assoc()) {
                    echo "<option value='" . $row['username'] . "'>" . $row['username'] . "</option>";
                }
            }
            ?>
        </select><br>

        <label for="client">Выберите пользователя:</label>
        <select id="client" name="client" required>
            <?php
            // Запрос на получение всех клиентов из таблицы roles
            $clientQuery = "SELECT username FROM roles WHERE role='client'";
            $clientResult = $conn->query($clientQuery);

            if ($clientResult->num_rows > 0) {
                while ($row = $clientResult->fetch_assoc()) {
                    echo "<option value='" . $row['username'] . "'>" . $row['username'] . "</option>";
                }
            }

            // Закрываем соединение
            $conn->close();
            ?>
        </select><br>
        <input type="hidden" id="username" name="username">

        <input type="submit" value="Создать ремонт">
    </form>
</body>

</html>
