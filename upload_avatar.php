<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="styles_registr_login.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="update_pass_script.js" defer></script>
    <title>Изменение пароля</title>
</head>

<body>
    <div id="message-container"></div>
    <div class="container">
        <h2>Изменение пароля</h2>
        <form action="update_pass_serv.php" method="post" onsubmit="return validateForm()">
            <input type="hidden" id="username" name="username"> <!-- Скрытое поле для передачи username -->
            <label for="old_password">Старый пароль:</label>
            <input type="password" id="old_password" name="old_password" required><br>

            <label for="new_password">Новый пароль:</label>
            <input type="password" id="new_password" name="new_password" required><br>

            <label for="confirm_password">Повторите новый пароль:</label>
            <input type="password" id="confirm_password" name="confirm_password" required><br>

            <button type="submit">Изменить пароль</button>
        </form>
    </div>

    <script>
        // Получение имени пользователя из локального хранилища
        var usernameFromLocalStorage = localStorage.getItem("username");

        // Установка значения username в скрытое поле формы
        document.getElementById("username").value = usernameFromLocalStorage;
    </script>
</body>

</html>
