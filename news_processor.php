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

// Функция для получения новостей из базы данных
function getNews() {
    $conn = connectToDatabase();

    $sql = "SELECT * FROM News ORDER BY publish_datetime DESC";
    $result = $conn->query($sql);

    $news = array();

    // Проверка наличия записей в таблице
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $news[] = $row;
        }
    } else {
        echo "Нет новостей.";
    }

    closeDatabaseConnection($conn);

    return $news;
}

?>
