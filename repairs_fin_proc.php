<?php
require_once('database_config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение значения repair_id из формы
$repair_id = $_POST['repair_id'];

// SQL-запрос для выбора данных из current_repairs
$sql_select = "SELECT * FROM current_repairs WHERE id_repair = ?";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bind_param("i", $repair_id);
$stmt_select->execute();
$result_select = $stmt_select->get_result();

if ($result_select->num_rows > 0) {
    $row = $result_select->fetch_assoc();

    // SQL-запрос для вставки данных в history_repairs
    $sql_insert = "INSERT INTO history_repairs (id_repair, mech_name, manager_name, client_name, car_brand, vin_number, start_date, finish_date, cost, status) 
                   VALUES (?,?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("issssssssi", $row['id_repair'],
    $row['mech_name'], $row['manager_name'], $row['client_name'], $row['car_brand'], $row['vin_number'], 
    $row['start_date'], $row['finish_date'], $row['cost'], $row['status']);

    // Выполнение SQL-запроса для вставки данных
    if ($stmt_insert->execute()) {
        // SQL-запрос для удаления записи из current_repairs
        $sql_delete = "DELETE FROM current_repairs WHERE id_repair = ?";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bind_param("i", $repair_id);
        
        // Выполнение SQL-запроса для удаления записи
        if ($stmt_delete->execute()) {
            echo "<script>alert('Отлично, продолжайте в том же духе!'); window.location.href = 'manager_dashboard.php';</script>";
        } else {
            echo "Ошибка при удалении записи из текущих ремонтов: " . $stmt_delete->error;
        }

        // Закрытие соединения с базой данных
        $stmt_delete->close();
    } else {
        echo "Ошибка при вставке данных в историю ремонтов: " . $stmt_insert->error;
    }

    // Закрытие соединения с базой данных
    $stmt_insert->close();
} else {
    echo "Запись не найдена в текущих ремонтах.";
}

// Закрытие соединения с базой данных
$stmt_select->close();
$conn->close();
?>
