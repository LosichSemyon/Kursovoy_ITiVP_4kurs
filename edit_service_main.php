<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование услуги</title>
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
            border: 8px solid #000;
    border-radius: 10px;
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
  padding: 5px 10px;
  margin: 5px;
  cursor: pointer;
  width: 300px;
}

        button:hover {
            background-color: #ccc;
        }
    </style>
</head>
<body>


<!-- Форма редактирования -->
<form id="editForm">
    <input type="hidden" name="action" value="editService">
    
    <label for="serviceName">Название услуги:</label>
    <input type="text" id="serviceName" name="serviceName" value="<?php echo isset($_GET['service_name']) ? htmlspecialchars($_GET['service_name']) : ''; ?>" readonly><br>

    <label for="newDescription">Новое описание:</label>
    <input type="text" id="newDescription" name="newDescription" required><br>
    
    <label for="newPrice">Новая цена:</label>
    <input type="text" id="newPrice" name="newPrice" required><br>
    
    <button type="button" onclick="editService()">Сохранить</button>
</form>

<script>
function editService() {
    // Получаем значения из формы
    var serviceName = document.getElementById("serviceName").value;
    var newDescription = document.getElementById("newDescription").value;
    var newPrice = document.getElementById("newPrice").value;

    // Отправляем данные на сервер с использованием Fetch API
    fetch('edit_service_handler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: "action=editService&serviceName=" + encodeURIComponent(serviceName) +
              "&newDescription=" + encodeURIComponent(newDescription) +
              "&newPrice=" + encodeURIComponent(newPrice),
    })
    .then(response => response.text())
    .then(data => {
        // Обработка ответа от сервера
        console.log(data);
        alert("Услуга успешно отредактирована.");
        window.location.href = 'uslugi_view.php';

    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>
</body>
</html>
