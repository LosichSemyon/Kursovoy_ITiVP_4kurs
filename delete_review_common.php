<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Reviews</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Удаление отзывов</h1>
            <button onclick="window.location.href='otzivi_main.php'">Назад к отзывам</button>
        </div>

        <form action="delete_review_common.php" method="post">
            <label for="username">Имя пользователя:</label>
            <input type="text" id="username" name="username" required>

            <input type="submit" value="Удалить отзывы">
        </form>
    </div>

    <?php
    // Проверяем, была ли отправлена форма
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Получаем имя пользователя из формы
        $usernameToDelete = $_POST['username'];

        // Подключение к файлу с функциями базы данных
        require_once('otzivi_proces.php');

        // Удаляем отзывы для заданного пользователя
        deleteReviewsByUsername($usernameToDelete);

        // Выводим сообщение об успешном удалении (может быть улучшено)
        echo "<p>Отзывы пользователя $usernameToDelete успешно удалены.</p>";
    }
    ?>
</body>

</html>
