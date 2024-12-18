<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Услуги</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="service-block">
    <div class="header">
            <h1>Список Услуг</h1>
            <?php
            // Переменная $role извлекается из локального хранилища с использованием JavaScript
            echo '<script>var role = localStorage.getItem("role");</script>';

            // Замените на вашу логику получения роли пользователя
            echo '<script>';
            echo 'if (role === "admin" || role === "manager") {';
            echo 'document.write("<button onclick=\"window.location.href=\'add_service_notcl.php\'\">Добавить услугу</button>");';
            echo '}';
            echo '</script>';
            ?>
        </div>

        <form method="get" action="">
            <label for="search">Поиск по названию:</label>
            <input type="text" id="search" name="search">
            <input type="submit" value="Найти">
        </form>
</div>
<div>
        <div >
            <?php
                echo "<script>";
                echo "var role = localStorage.getItem('role');";
                echo "</script>";
            
            require_once('uslugi_serv.php');
         
            if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["search"])) {
                $searchTerm = $_GET["search"];
                $services = searchServices($searchTerm);
            } else {
                // Если форма не отправлена, отобразить все услуги
                $services = getServices();
            }
            foreach ($services as $service) {
                echo "<div class='service-block'>";
                echo "<h3>" . $service['service_name'] . "</h3>";
                echo "<p>" . $service['description'] . "</p>";
                echo "<p>Цена: $" . $service['price'] . "</p>";

                echo "<script>";
                echo "if (role === 'admin' || role === 'manager') {";
                echo "  document.write('<button id=\"editButton\" onclick=\"window.location.href=\'edit_service_main.php?service_name=" . $service['service_name'] . "\'\">Редактировать</button>');";
                echo "  document.write('<button id=\"deleteButton\" onclick=\"deleteService(\'" . $service['service_name'] . "\')\">Удалить</button>');";
                echo "}";
                echo "</script>";

                echo "</div>";
            }
            ?>
        </div>
    </div>

    <script>
function deleteService(service_name) {
    var confirmation = confirm("Вы уверены, что хотите удалить услугу?");
    if (confirmation) {
        fetch('delete_service.php?service_name=' + encodeURIComponent(service_name), {
            method: 'GET',
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Network response was not ok (${response.status} ${response.statusText})`);
            }
            return response.json();
        })
        .then(data => {
            // Проверяем успешность операции
            if (data.success) {
                alert('Услуга успешно удалена!');
                // Обновляем страницу после успешного удаления
                window.location.href = 'uslugi_view.php'; // Используем window.location.href вместо location.reload()
            } else {
                alert('Ошибка при удалении услуги: ' + data.error);
            }
        })
        .catch(error => console.error("Fetch error:", error));
    }
}


</script>

</body>

</html>
