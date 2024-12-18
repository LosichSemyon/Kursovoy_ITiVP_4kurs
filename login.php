<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="styles_registr_login.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="login_script.js" defer></script>
    <title>Авторизация</title>
</head>

<body>
<div id="message-container"></div>
<div class="container">
    <h2>Авторизация</h2>
    <form action="login_process.php" method="post">
        <label for="username">Имя пользователя:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required><br>
        <button type="submit">Войти</button>
    </form>
</div>
</body>

</html>
