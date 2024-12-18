<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить новую услугу</title>
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
    <div class="container">
        <div class="header">
            <h1>Добавить новую услугу</h1>
            <button onclick="window.location.href='uslugi_view.php'">Назад к списку услуг</button>
        </div>

        <form id="addServiceForm" action="process_add_service.php" method="post">
            <label for="service_name">Название услуги:</label>
            <input type="text" id="service_name" name="service_name" required>

            <label for="description">Описание:</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <label for="price">Цена:</label>
            <input type="number" id="price" name="price" min="0" step="0.01" required>

            <input type="submit" value="Добавить услугу">
        </form>
    </div>
    <script>
        // Обработчик отправки формы
        document.getElementById("addServiceForm").addEventListener("submit", function (event) {
            event.preventDefault();

            fetch("process_add_service.php", {
                method: "POST",
                body: new FormData(event.target),
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Network response was not ok (${response.status} ${response.statusText})`);
                }
                return response.json();
            })
            .then(data => {
                
                if (data.success) {
                    alert('Услуга успешно добавлена!');
                    document.getElementById('addServiceForm').reset(); 
                    window.location.href = 'uslugi_view.php'; 
                } else {
                    alert('Ошибка при добавлении услуги: ' + data.error);
                }
            })
            .catch(error => console.error("Fetch error:", error));
        });
    </script>
</body>

</html>
