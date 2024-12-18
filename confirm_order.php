<?php
// Подключение к базе данных (замените значения переменных на ваши)
require_once('database_config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение значения username из URL
$username = $_GET['username'];

// SQL-запрос для получения данных из базы данных
$sql = "SELECT id_repair FROM current_repairs WHERE status = 3 AND manager_name = '$username'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        form {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form action="repairs_fin_proc.php" method="post"> <!-- Укажите обработчик формы -->
        <label for="repair_id">Выберите ремонт:</label>
        <select name="repair_id" id="repair_id">
            <?php
            // Вывод данных из SQL-запроса в выпадающий список
            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . $row['id_repair'] . '">' . $row['id_repair'] . '</option>';
            }
            ?>
        </select>
        <input type="submit" value="Подтвердить">
    </form>
</body>
</html>

<?php
// Закрытие соединения с базой данных
$conn->close();
?>
