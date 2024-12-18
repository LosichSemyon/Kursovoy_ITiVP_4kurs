<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ожидается подтверждение аккаунта</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        
        .message {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="message">
        <h1>ОЖИДАЕТСЯ ПОДТВЕРЖДЕНИЕ АККАУНТА У АДМИНИСТРАТОРА</h1>
        <p id="datetime"></p>
    </div>

    <script>
        function updateDateTime() {
            var datetimeElement = document.getElementById("datetime");
            var currentDateTime = new Date();
            var formattedDateTime = currentDateTime.toLocaleString('ru-RU', {
                day: 'numeric',
                month: 'numeric',
                year: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric'
            });
            datetimeElement.textContent = "Дата и время: " + formattedDateTime;
        }

        // Обновляем дату и время каждую секунду
        setInterval(updateDateTime, 1000);
    </script>
</body>
</html>