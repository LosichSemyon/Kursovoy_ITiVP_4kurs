<?php
require_once('database_config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$repair_id = $_POST['repair_id'];

$sql_select = "SELECT * FROM current_repairs WHERE id_repair = ?";
$stmt_select = $conn->prepare($sql_select);
$stmt_select->bind_param("i", $repair_id);
$stmt_select->execute();
$result_select = $stmt_select->get_result();

if ($result_select->num_rows > 0) {
    $row = $result_select->fetch_assoc();

    $sql_update = "UPDATE current_repairs SET status = 3 WHERE id_repair = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("i", $repair_id);

    if ($stmt_update->execute()) {
        echo "<script>alert('Статус ремонта успешно изменен!'); window.location.href = 'remont_order_client.php';</script>";
    } else {
        echo "Ошибка при обновлении статуса ремонта: " . $stmt_update->error;
    }

    $stmt_update->close();
} else {
    echo "Запись не найдена в текущих ремонтах.";
}

$stmt_select->close();
$conn->close();
?>
