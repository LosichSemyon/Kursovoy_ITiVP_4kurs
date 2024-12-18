<?php
// Подключение к базе данных
require_once('database_config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

// Обработка формы
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Проверка наличия и не пустоты данных
    if (
        isset($_POST["selectedRepair"]) && !empty($_POST["selectedRepair"]) &&
        isset($_POST["selectedCar"]) && !empty($_POST["selectedCar"]) &&
        isset($_POST["username"]) && !empty($_POST["username"])
    ) {
        // Разбиваем значение selectedRepair на id_repair и vin_number
        list($id_repair, $vin_number) = explode('|', $_POST["selectedRepair"]);

        $username = $_POST["username"];
        $selectedCar = $_POST["selectedCar"];

        // Получение бренда по VIN из таблицы cars
        $get_brand_sql = "SELECT brand FROM cars WHERE vin_number = ?";
        $get_brand_stmt = $conn->prepare($get_brand_sql);
        $get_brand_stmt->bind_param("s", $selectedCar);
        $get_brand_stmt->execute();
        $get_brand_stmt->bind_result($brand);
        $get_brand_stmt->fetch();
        $get_brand_stmt->close();

        // Обновление записи в current_repairs
        $update_sql = "UPDATE current_repairs SET vin_number = ?, status = 1, car_brand = ? WHERE id_repair = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssi", $selectedCar, $brand, $id_repair);

        if ($update_stmt->execute()) {
            echo "<script>alert('Ремонт успешно обновлен!'); window.location.href = 'remont_order_client.php';</script>";
        } else {
            echo "Ошибка при обновлении записи в текущих ремонтах: " . $update_stmt->error;
        }

        // Закрытие соединения с базой данных
        $update_stmt->close();
    } else {
        echo "Пожалуйста, заполните все обязательные поля.";
    }
}

// Закрытие соединения с базой данных
$conn->close();
?>
