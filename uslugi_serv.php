<?php


// Функция для подключения к базе данных
function connectToDatabase() {require_once('database_config.php');
    $conn = new mysqli($servername, $username, $password, $dbname);


    // Проверка соединения
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

// Функция для закрытия соединения с базой данных
function closeDatabaseConnection($conn) {
    $conn->close();
}

function getServices() {
    $conn = connectToDatabase();

    $sql = "SELECT * FROM services ORDER BY id DESC";
    $result = $conn->query($sql);

    $services = array();

    // Проверка наличия записей в таблице
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $services[] = $row;
        }
    } else {
        echo "Нет услуг";
    }

    closeDatabaseConnection($conn);

    return $services;
}


function addService($service_name, $description, $price)
{
    // Подключение к базе данных
    $conn = connectToDatabase();

    try {
        // Подготовка SQL-запроса
        $sql = "INSERT INTO services (service_name, description, price) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Выполнение SQL-запроса с передачей данных
        $stmt->bind_param("ssd", $service_name, $description, $price);
        $stmt->execute();
    } catch (Exception $e) {
        // Обработка ошибок, если необходимо
        echo "Error: " . $e->getMessage();
    }

    // Закрытие соединения с базой данных
    closeDatabaseConnection($conn);
}

function editServiceByName($service_name, $new_description, $new_price)
{
    // Подключение к базе данных
    $conn = connectToDatabase();

    try {
        // Подготовка SQL-запроса
        $sql = "UPDATE services SET description = ?, price = ? WHERE service_name = ?";
        $stmt = $conn->prepare($sql);

        // Выполнение SQL-запроса с передачей данных
        $stmt->bind_param("sds", $new_description, $new_price, $service_name);
        $stmt->execute();
    } catch (Exception $e) {
        // Обработка ошибок, если необходимо
        echo "Error: " . $e->getMessage();
    }

    // Закрытие соединения с базой данных
    closeDatabaseConnection($conn);
}

// Функция для поиска услуги по названию
function searchServices($searchTerm) {
    // Подключение к базе данных
    $conn = connectToDatabase();

    // Подготовка SQL-запроса с использованием параметров
    $sql = "SELECT * FROM services WHERE service_name LIKE ?";
    $stmt = $conn->prepare($sql);

    // Привязка параметра
    $searchTerm = "%" . $searchTerm . "%";
    $stmt->bind_param("s", $searchTerm);

    // Выполнение SQL-запроса
    $stmt->execute();

    // Получение результатов
    $result = $stmt->get_result();
    $services = $result->fetch_all(MYSQLI_ASSOC);

    // Закрытие соединения с базой данных
    closeDatabaseConnection($conn);

    return $services;
}

function deleteServicesByServiceName($service_name)
{
    // Подключение к базе данных
    $conn = connectToDatabase();

    try {
        // Подготовка SQL-запроса
        $sql = "DELETE FROM services WHERE service_name = ?";
        $stmt = $conn->prepare($sql);

        // Выполнение SQL-запроса с передачей данных
        $stmt->bind_param("s", $service_name);
        $stmt->execute();

        // Проверяем, была ли удалена хотя бы одна запись
        if ($stmt->affected_rows > 0) {
            return ["success" => true];
        } else {
            return ["success" => false, "error" => "Услуга не найдена"];
        }
    } catch (Exception $e) {
        // Обработка ошибок, если необходимо
        return ["success" => false, "error" => "Error: " . $e->getMessage()];
    } finally {
        // Закрытие соединения с базой данных
        closeDatabaseConnection($conn);
    }
}


// Поиск услуги по названию
function searchServiceByName($service_name) {
    $conn = connectToDatabase();

    $sql = "SELECT * FROM services WHERE service_name LIKE ?";
    $stmt = $conn->prepare($sql);
    $service_name_param = "%" . $service_name . "%";
    $stmt->bind_param("s", $service_name_param);
    $stmt->execute();

    $result = $stmt->get_result();

    $services = array();

    // Проверка наличия записей в результате поиска
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $services[] = $row;
        }
    } else {
        echo "Нет результатов поиска";
    }

    closeDatabaseConnection($conn);

    return $services;
}



?>
