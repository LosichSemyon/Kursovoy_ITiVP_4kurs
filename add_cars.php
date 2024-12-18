<!DOCTYPE html>
<html>
<head>
    <title>Страница добавления автомобиля</title>
    <style>
        .form-container {
            max-width: 400px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
        }

        .form-group .error-message {
            color: red;
            margin-top: 5px;
        }

        .success-message {
            color: green;
            margin-top: 10px;
        }

        .submit-button {
            background-color: yellow;
  color: #000;
  border: 2px solid #000;
  border-radius: 5px;
  padding: 10px 20px;
  margin: 10px;
  cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Страница добавления автомобиля</h1>

    <div class="form-container">
        <form id="car-form">
            <div class="form-group">
                <label for="username">Имя пользователя:</label>
                <input type="text" id="username" name="username" value="" readonly>
            </div>
            <div class="form-group">
                <label for="brand">Марка автомобиля:</label>
                <input type="text" id="brand" name="brand" required>
            </div>
            <div class="form-group">
                <label for="license_plate">Госномер автомобиля:</label>
                <input type="text" id="license_plate" name="license_plate" required>
            </div>
            <div class="form-group">
                <label for="color">Цвет автомобиля:</label>
                <input type="text" id="color" name="color" required>
            </div>
            <div class="form-group">
                <label for="year">Год выпуска автомобиля:</label>
                <input type="number" id="year" name="year" required>
            </div>
            <div class="form-group">
                <label for="vin_number">ВИН номер кузова:</label>
                <input type="text" id="vin_number" name="vin_number" required>
            </div>
            <button type="submit" class="submit-button">Добавить автомобиль</button>
        </form>
    </div>

    <script>
        // Подтягивание имени пользователя из LocalStorage
        var username = localStorage.getItem('username');
        document.getElementById('username').value = username;

        // Обработка отправки формы
        document.getElementById('car-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Предотвращение отправки формы по умолчанию

            // Получение данных формы
            var brand = document.getElementById('brand').value;
            var licensePlate = document.getElementById('license_plate').value;
            var color = document.getElementById('color').value;
            var year = document.getElementById('year').value;
            var vinNumber = document.getElementById('vin_number').value;

            // Валидация данных
            if (brand === '' || licensePlate === '' || color === '' || year === '' || vinNumber === '') {
                alert('Пожалуйста, заполните все поля формы.');
                return;
            }

            // Отправка данных на сервер
            fetch('add_cars_serv.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    username: username,
                    brand: brand,
                    license_plate: licensePlate,
                    color: color,
                    year: year,
                    vin_number: vinNumber
                })
            })
                .then(function(response) {
                    if (response.ok) {
                        alert('Автомобиль успешно добавлен!');
                        document.getElementById('car-form').reset();
                        window.location.href = 'car_user_view.php'; // Сброс формы
                    } else {
                        alert('Ошибка при добавлении автомобиля.');
                        window.location.href = 'car_user_view.php';
                    }
                })
                .catch(function(error) {
                    console.log('Произошла ошибка:', error);
                    alert('Произошла ошибка при отправке запроса на сервер.');
                });
        });
    </script>
</body>
</html>