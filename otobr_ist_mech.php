<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>История заказов</title>
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

        .clear-button {
            margin-top: 10px;
            padding: 8px;
            background-color: #ff0000;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <h2>История заказов</h2>

    <div id="history-container"></div>

    <script>
        // Загрузка имени пользователя из localStorage
        document.addEventListener("DOMContentLoaded", function () {
            var storedUsername = localStorage.getItem("username");

            // AJAX-запрос на сервер для получения данных
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "get_history_mech.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Обработка ответа, например, вставка данных в элемент на странице
                    document.getElementById("history-container").innerHTML = xhr.responseText;
                }
            };
            xhr.send("username=" + encodeURIComponent(storedUsername));
        });

    </script>
</body>

</html>
