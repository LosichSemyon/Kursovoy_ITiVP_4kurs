<?php

$partId = $_GET['partId'];
// Затем продолжайте с создания HTML-страницы с использованием $partId
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование запчасти</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h1 {
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }

        textarea {
            height: 80px;
        }

        button {
            background-color: yellow;
            color: #000;
            border: 2px solid #000;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background-color: #ccc;
        }
    </style>
</head>
<body>
    <h1>Редактирование запчасти</h1>
    <form id="editPartForm">
        <!-- Формы для ввода данных -->
        <label for="partName">Название:</label>
        <input type="text" id="partName" name="partName" required>
        
        <label for="partDescription">Описание:</label>
        <textarea id="partDescription" name="partDescription"></textarea>

        <label for="partPrice">Цена:</label>
        <input type="number" id="partPrice" name="partPrice" step="0.01" required>

        <label for="partStock">Остаток на складе:</label>
        <input type="number" id="partStock" name="partStock" required>

        <button type="button" onclick="updatePart(<?php echo $partId; ?>)">Подтвердить</button>
    </form>
    <script src="scr_edit_parts.js"></script>
</body>
</html>
