<?php

require_once('database_config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$conn->set_charset("utf8"); 

$sql = "SELECT status, COUNT(*) as count FROM current_repairs GROUP BY status";
$result = $conn->query($sql);


if (!$result) {
    die("Query failed: " . $conn->error);
}


$data = array();
while ($row = $result->fetch_assoc()) {
    $status = intval($row["status"]);
    $count = intval($row["count"]);
    $data[] = array("status" => $status, "count" => $count);
}


if (empty($data)) {
    die("No data found");
}

$json_data = json_encode($data, JSON_UNESCAPED_UNICODE);

echo $json_data;

// Закрытие соединения с базой данных
$conn->close();
?>
