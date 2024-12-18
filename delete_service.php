<?php
require_once('uslugi_serv.php');

// Проверка метода запроса
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Получаем имя услуги из запроса
    $service_name = $_GET["service_name"];

    // Вызываем функцию для удаления услуги
    $result = deleteServicesByServiceName($service_name);

    // Возвращаем результат операции в виде JSON
    header("Content-Type: application/json");
    echo json_encode($result);
    exit();
} else {
    // Если запрос не является GET-запросом, перенаправляем пользователя на страницу с услугами
    header("Location: uslugi_view.php");
    exit();
}

?>
