<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавить отзыв</title>
   <style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
}

.container {
    max-width: 600px;
    margin: 0 auto;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

button {
    background-color: #4285f4;
    color: #fff;
    border: none;
    padding: 10px 15px;
    cursor: pointer;
    border-radius: 5px;
}

form {
    display: grid;
    gap: 10px;
}

label {
    font-weight: bold;
}

input,
textarea {
    width: 100%;
    padding: 10px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 5px;
}

input[type="submit"] {
    background-color: #4caf50;
    color: #fff;
    cursor: pointer;
}

input[type="submit"]:hover {
    background-color: #45a049;
}
</style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Добавить отзыв</h1>
            <button onclick="window.location.href='otzivi_main.php'">Назад к отзывам</button>
        </div>

        <form action="proces_review.php" method="post">
            <label for="username">Ваше имя:</label>
            <input type="text" id="username" name="username" required>

            <label for="review_text">Отзыв:</label>
            <textarea id="review_text" name="review_text" rows="4" required></textarea>

            <label for="rating">Оценка:</label>
            <input type="number" id="rating" name="rating" min="1" max="5" required>

            <input type="submit" value="Добавить отзыв">
        </form>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Проверяем, есть ли имя в localStorage
            var username = localStorage.getItem("username");

            // Заполняем поле "Ваше имя" из localStorage, если имя есть
            if (username) {
                document.getElementById("username").value = username;
            }
        });
    </script>
</body>

</html>
