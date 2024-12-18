<?php
require_once('database_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST['username'];

    $sql_select = "SELECT * FROM current_repairs WHERE mech_name = ? AND status = 1";
    $stmt_select = $conn->prepare($sql_select);
    $stmt_select->bind_param("s", $username);
    $stmt_select->execute();
    $result_select = $stmt_select->get_result();

    if ($result_select->num_rows > 0) {
        echo '<thead><tr><th>ID Ремонта</th><th>Механик</th><th>Клиент</th><th>Марка авто</th><th>Дата начала</th><th>Статус</th><th>Действия</th></tr></thead><tbody>';
        while ($row = $result_select->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row['id_repair'] . '</td>';
            echo '<td>' . $row['mech_name'] . '</td>';
            echo '<td>' . $row['client_name'] . '</td>';
            echo '<td>' . $row['car_brand'] . '</td>';
            echo '<td>' . $row['start_date'] . '</td>';
            echo '<td>' . $row['status'] . '</td>';
            echo '<td><button class="acceptOrderBtn" data-repair_id="' . $row['id_repair'] . '">Принять заказ</button></td>';
            echo '</tr>';
        }
        echo '</tbody>';
    } else {
        echo '<tr><td colspan="7">Нет текущих ремонтов для механика ' . $username . '.</td></tr>';
    }

    $stmt_select->close();
    $conn->close();
} else {
    echo 'Invalid request.';
}
?>
