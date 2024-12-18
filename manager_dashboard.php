<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель менеджера</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .button-container {
            margin-top: 10px;
        }

        .action-button {
            padding: 8px;
            margin-right: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h2>Панель менеджера</h2>

    <div id="message-container"></div>

    <table>
        <tr>
            <th>ID Ремонта</th>
            <th>Механик</th>
            <th>Менеджер</th>
            <th>Клиент</th>
            <th>Марка авто</th>
            <th>VIN-номер</th>
            <th>Дата начала</th>
            <th>Дата завершения</th>
            <th>Стоимость</th>
            <th>Статус</th>
        </tr>
        <!-- Здесь будут отображаться текущие ремонты -->
    </table>

    <div class="button-container">
        <button class="action-button" onclick="createInvitation()">Создать приглашение</button>
        <button class="action-button" onclick="confirmOrder()">Подтвердить заказ</button>
    </div>

    <script>
        // Получение имени пользователя из localStorage
        var username = localStorage.getItem("username");

        // Отображение имени пользователя
        document.getElementById("message-container").innerText = "Добро пожаловать, " + username + "!";

        // Вызов функции для загрузки текущих ремонтов
        loadCurrentRepairs();

        function loadCurrentRepairs() {
            // AJAX-запрос на сервер для получения текущих ремонтов
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "get_current_repairs.php?username=" + username, true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Обработка ответа и отображение текущих ремонтов
                    document.querySelector("table").innerHTML = xhr.responseText;
                }
            };

            xhr.send();
        }

        function createInvitation() {
            var username = localStorage.getItem("username");

    // Перенаправление на страницу создания ремонта с добавлением параметра в URL
    window.location.href = "create_repair_form.php?username=" + encodeURIComponent(username);
        }

        function confirmOrder() {
            var username = localStorage.getItem("username");

    // Перенаправление на страницу создания ремонта с добавлением параметра в URL
    window.location.href = "confirm_order.php?username=" + encodeURIComponent(username);
        }
    </script>
</body>

</html>
