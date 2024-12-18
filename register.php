<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles_registr_login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <script src="registr_script.js" defer></script>
</head>

<body>
<div id="message-container"></div>

<div class="container">
    <h2>Регистрация</h2>
    <form action="register_process.php" method="post" onsubmit="return validateForm()">
        <label for="username">Имя пользователя:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="email">Почта:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required><br>
        <label for="confirm_password">Повторите пароль:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br>
        <button type="submit">Зарегистрироваться</button>
    </form>
</div>
<div id="loader" class="loader"></div>
</body>

</html>


