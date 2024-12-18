<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оценки и отзывы</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Отзывы на Autoservice.mydev!</h1>
       
           
            <button id="addReviewButton" onclick="window.location.href='otzovi_add_client.php'">Добавить отзыв</button>
        <button id="deleteReviewButton" onclick="window.location.href='delete_review_common.php'">Удалить отзыв</button>  
    </div>

        
    </div>
<div class="news-container">
<?php
    require_once('otzivi_proces.php');
$reviews = getNews();

    foreach ($reviews as $review) {
        echo "<div class='news-block'>";
        echo "<div class='news-content'>";
        echo "<p><strong>Пользователь:</strong> " . $review['username'] . "</p><br>" ;
        echo "<p><strong>Отзыв:</strong> " . $review['review_text'] . "</p><br>";
        echo "<p><strong>Оценка:</strong> " . $review['rating'] . "</p><br>";
        echo "<div class='news-date'> " . date('Y-m-d', strtotime($review['review_date'])) . "</div>";
        echo "</div></div>";
    }
?>
        </div>

        <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Проверяем, есть ли имя в localStorage
            var username = localStorage.getItem("username");
            var role = localStorage.getItem("role");

if (role === "manager" || role === "admin") {
    var addReviewButton = document.getElementById("deleteReviewButton");
    addReviewButton.style.display = "inline"; // или "inline" в зависимости от типа элемента
} else {
    var addReviewButton = document.getElementById("deleteReviewButton");
    addReviewButton.style.display = "none";
}

            if (!username) {
                var addReviewButton = document.getElementById("addReviewButton");
                addReviewButton.style.display = "none";
            }
        });
    </script>
</body>

</html>
