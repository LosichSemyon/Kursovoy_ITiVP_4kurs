<?php
// Обработчик формы
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'editService') {
    // Получаем данные из формы
    $serviceName = $_POST['serviceName'];
    $newDescription = $_POST['newDescription'];
    $newPrice = $_POST['newPrice'];

    // Подключаем ваш файл с функцией editServiceByName
    require_once('uslugi_serv.php');

    // Вызываем функцию редактирования
    editServiceByName($serviceName, $newDescription, $newPrice);

    // Выводим ответ клиенту
    echo 'success';
}
?>
