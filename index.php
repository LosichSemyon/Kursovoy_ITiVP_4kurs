<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="media\loader.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Добро пожаловать на Autoservice.mydev</h1>
            <h2> для продолжения зарегистрируйтесь или войдите.</h2>
            <button onclick="window.location.href='register.php'">Регистрация</button>
            <button onclick="window.location.href='login.php'">Авторизация</button>
            <button onclick="window.location.href='otzivi_main.php'">Оценки и отзывы</button>
        </div>

        
    </div>
<div class="news-container">
            <?php
                // Подключение к файлу с функциями базы данных
                require_once('news_processor.php');

                // Получение новостей
                $news = getNews();

                // Вывод блоков с новостями
                foreach ($news as $row) {
                    echo "<div class='news-block'>";
                    echo "<img class='news-image' src='" . $row['image_url'] . "' alt='News Image'>";
                    echo "<div class='news-content'>";
                    echo "<h3>" . $row['title'] . "</h3>";
                    echo "<p>" . $row['description'] . "</p>";
                    echo "<a href='" . $row['link'] . "'>Подробнее</a>";
                    echo "<div class='news-date'>" . date('Y-m-d H:i:s', strtotime($row['publish_datetime'])) . "</div>"; // Выводим дату
                    echo "</div></div>";
                }
                              
            ?>
        </div>

        <script>
        // Очистка localStorage при загрузке страницы
        localStorage.removeItem('username');
        localStorage.removeItem('role')
    </script>
</body>

</html>
