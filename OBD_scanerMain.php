<!DOCTYPE html>
<html>
<head>
    <title>Диагностика автомобиля</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
        }

        h1 {
            margin-top: 100px;
        }

        p {
            font-size: 14px;
        }
        button {
            background-color: yellow;
            color: #000;
            border: 2px solid #000;
            border-radius: 5px;
            padding: 10px 20px;
            margin: 10px;
            cursor: pointer;
        }

        button:hover {
            background-color: #ccc;
        }

    </style>
</head>
<body>
    <h1>Диагностика автомобиля</h1>
    <p>Чтобы начать диагностику, подключите автомобиль к OBD.</p>
    <button onclick="startDiagnostic()">Начать диагностику</button>

    <div id="errorList"></div>

    <script>
        function startDiagnostic() {
            // AJAX запрос к серверу для получения списка ошибок
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var errors = JSON.parse(xhr.responseText);
                        displayErrors(errors);
                    } else {
                        console.error('Ошибка при получении списка ошибок');
                    }
                }
            };
            xhr.open('GET', 'OBD_scanerPr.php', true);
            xhr.send();
        }

        function displayErrors(errors) {
            var errorList = document.getElementById('errorList');
            errorList.innerHTML = '';

            // Генерация случайного числа от 1 до 5 для определения количества ошибок
            var numErrors = Math.floor(Math.random() * 5) + 1;

            // Случайный выбор ошибок
            var selectedErrors = [];
            for (var i = 0; i < numErrors; i++) {
                var randomIndex = Math.floor(Math.random() * errors.length);
                selectedErrors.push(errors[randomIndex]);
                errors.splice(randomIndex, 1);
            }

            // Вывод информации об ошибках
            var errorListElement = document.createElement('ul');
            for (var j = 0; j < selectedErrors.length; j++) {
                var error = selectedErrors[j];
                var listItem = document.createElement('li');
                listItem.innerHTML = '<strong>' + error.error_code + '</strong>: ' + error.error_name + '<br>' + error.error_description;
                errorListElement.appendChild(listItem);
            }

            errorList.appendChild(errorListElement);
        }
    </script>
</body>
</html>