<!DOCTYPE html>
<html>
<head>
    <title>Страница с автомобилями</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }

        .delete-button {
            background-color: red;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 6px 12px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: darkred;
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var storedUsername = localStorage.getItem('username');
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'fetch_cars.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    document.getElementById('carTable').innerHTML = xhr.responseText;
                    addDeleteButtons(); // Добавление кнопок "Удалить" после загрузки таблицы
                }
            };
            xhr.send('username=' + storedUsername);
        });

        function deleteCar(vin_number) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'delete_car.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    // Перезагружаем таблицу после удаления записи
                    var storedUsername = localStorage.getItem('username');
                    reloadCarTable(storedUsername);
                }
            };
            xhr.send('carId=' + vin_number);
        }

        function reloadCarTable(username) {
            var xhrReload = new XMLHttpRequest();
            xhrReload.open('POST', 'fetch_cars.php', true);
            xhrReload.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhrReload.onreadystatechange = function() {
                if (xhrReload.readyState === XMLHttpRequest.DONE && xhrReload.status === 200) {
                    document.getElementById('carTable').innerHTML = xhrReload.responseText;
                    addDeleteButtons(); // Добавление кнопок "Удалить" после обновления таблицы
                }
            };
            xhrReload.send('username=' + username);
        }

        function loadOtherPage() {
            // Загрузка другой страницы
            window.location.href = 'other_page.php';
        }

        function addDeleteButtons() {
  var table = document.getElementById("carTable");
  var rows = table.getElementsByTagName("tr");
  
  // Проверка, есть ли доступные автомобили для пользователя
  if (rows.length >= 0) {
    for (var i = 0; i < rows.length; i++) {
      var deleteButton = document.createElement("button");
      deleteButton.className = "delete-button";
      deleteButton.innerHTML = "Удалить";
      deleteButton.onclick = (function (row) {
        return function () {
          var carId = row.cells[4].innerHTML;
          deleteCar(carId);
        };
      })(rows[i]);
      var cell = rows[i].insertCell(-1);
      cell.appendChild(deleteButton);
    }
  }
}
    </script>
</head>
<body>
    <h1>Страница с автомобилями</h1>

    <p>Автомобили пользователя <span id="username"></span></p>

    <table id="carTable">
        <tr>
            <th>Марка</th>
            <th>Гос. номер</th>
            <th>Цвет</th>
            <th>Год</th>
            <th>VIN номер</th>
        </tr>
    </table>

    <button onclick="location.href='add_cars.php'">Добавить новый автомобиль</button>

    <script>
        var storedUsername = localStorage.getItem('username');
        document.getElementById('username').textContent = storedUsername;
    </script>
</body>
</html>
