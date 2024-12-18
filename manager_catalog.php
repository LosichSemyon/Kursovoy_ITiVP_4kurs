<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление ценами на запчасти</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .delete-button, .edit-button {
            background-color: #f44336;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .delete-button:hover, .edit-button:hover {
            background-color: #d32f2f;
        }

        .sort-button {
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .sort-button:hover {
            background-color: #45a049;
        }

        .search-input {
            margin-bottom: 10px;
            padding: 6px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .search-button {
            background-color: #2196F3;
            color: white;
            padding: 6px 12px;
            text-decoration: none;
            display: inline-block;
            margin-right: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .search-button:hover {
            background-color: #0b7dda;
        }
    </style>
</head>
<body>
    <h1>Управление каталогом</h1>

    <!-- Поле для поиска по названию -->
    <input type="text" id="searchName" class="search-input" placeholder="Поиск по названию">
    <!-- Кнопка для поиска по названию -->
    <button id="searchByName" class="search-button" onclick="searchParts('name')">Поиск по названию</button>

    <!-- Поле для поиска по артикулу (SKU) -->
    <input type="text" id="searchSku" class="search-input" placeholder="Поиск по артикулу (SKU)">
    <!-- Кнопка для поиска по артикулу -->
    <button id="searchBySku" class="search-button" onclick="searchParts('sku')">Поиск по артикулу</button>

    <!-- Кнопка для сортировки по цене -->
    <button id="sortPrice" class="sort-button" onclick="sortTableByPrice()">Сортировать по цене</button>

    <!-- Кнопка для сортировки по остаткам на складе -->
    <button id="sortStock" class="sort-button" onclick="sortTableByStock()">Сортировать по остаткам</button>

    <!-- Таблица для отображения данных о запчастях -->
    <table id="partsTable">
        <!-- Здесь будут строки таблицы с данными -->
    </table>

    <script src="scr_manager_cat.js"></script>
</body>
</html>
