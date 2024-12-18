<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <script src="admin_car.js" defer></script>
</head>
<body>
    <h1>Страница с автомобилями</h1>

    <input type="text" id="searchVin" placeholder="Поиск по VIN номеру">
    <button onclick="searchByVin()">Искать</button>

    <input type="text" id="searchUsername" placeholder="Поиск по имени пользователя">
    <button onclick="searchByUsername()">Искать</button>

    <button onclick="sortTable('ASC')">Сортировать по году (возрастание)</button>
    <button onclick="sortTable('DESC')">Сортировать по году (убывание)</button>

    <button onclick="showAll()">Отобразить все</button>

    <p>Все автомобили пользователей</p>

    <table id="carTable">
        <tr>
            <th>имя пользователя</th>
            <th>Марка</th>
            <th>Гос. номер</th>
            <th>Цвет</th>
            <th>Год</th>
            <th>VIN номер</th>
            <th>Действия</th>
        </tr>
    </table>
</body>
</html>
