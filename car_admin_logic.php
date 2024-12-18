<?php
require_once('database_config.php');
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function getAllCars($conn) {
    $sql = "SELECT * FROM cars";
    $result = $conn->query($sql);

    $data = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    return $data;
}

function deleteCar($conn, $carId) {
    $sql = "DELETE FROM cars WHERE vin_number = '$carId'";
    $result = $conn->query($sql);

    if ($result === TRUE) {
        echo "Car deleted successfully";
    } else {
        echo "Error deleting car: " . $conn->error;
    }
}

function sortCarsByYear($conn, $order) {
    $sql = "SELECT * FROM cars ORDER BY year $order";
    $result = $conn->query($sql);

    $data = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    return $data;
}

function searchCarsByVin($conn, $vin) {
    $sql = "SELECT * FROM cars WHERE vin_number LIKE '%$vin%'";
    $result = $conn->query($sql);

    $data = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    return $data;
}

function searchCarsByUsername($conn, $username) {
    $sql = "SELECT * FROM cars WHERE username LIKE '%$username%'";
    $result = $conn->query($sql);

    $data = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    return $data;
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'getAllCars':
            $data = getAllCars($conn);
            break;
        case 'deleteCar':
            $carId = $_POST['carId'];
            deleteCar($conn, $carId);
            break;
        case 'sortCarsByYear':
            $order = $_GET['order'];
            $data = sortCarsByYear($conn, $order);
            break;
        case 'searchCarsByVin':
            $vin = $_GET['vin'];
            $data = searchCarsByVin($conn, $vin);
            break;
        case 'searchCarsByUsername':
            $username = $_GET['username'];
            $data = searchCarsByUsername($conn, $username);
            break;
        default:
            $data = getAllCars($conn);
            break;
    }

    foreach ($data as $row) {
        echo "<tr>";
        echo "<td>" . $row["username"] . "</td>";
        echo "<td>" . $row["brand"] . "</td>";
        echo "<td>" . $row["license_plate"] . "</td>";
        echo "<td>" . $row["color"] . "</td>";
        echo "<td>" . $row["year"] . "</td>";
        echo "<td>" . $row["vin_number"] . "</td>";
        echo "<td><button class='delete-button' onclick='deleteCar(\"" . $row["vin_number"] . "\")'>Удалить</button></td>";
        echo "</tr>";
    }
}

$conn->close();
?>
