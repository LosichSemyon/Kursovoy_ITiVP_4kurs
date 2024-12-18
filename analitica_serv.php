<?php
require_once('database_config.php');

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8"); 
$sql = "SELECT part_name, part_stock FROM car_parts";
$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = array("label" => $row["part_name"], "value" => $row["part_stock"]);
}

if (empty($data)) {
    die("No data found");
}

$json_data = json_encode($data, JSON_UNESCAPED_UNICODE);

echo $json_data;

$conn->close();
?>
