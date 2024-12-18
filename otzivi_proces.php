<?php


function connectToDatabase() {require_once('database_config.php');
    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}

function closeDatabaseConnection($conn) {
    $conn->close();
}

function getNews() {
    $conn = connectToDatabase();

    $sql = "SELECT * FROM reviews ORDER BY review_date DESC";
    $result = $conn->query($sql);

    $news = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $news[] = $row;
        }
    } else {
        echo "Нет отзывов";
    }

    closeDatabaseConnection($conn);

    return $news;
}

function addReview($username, $review_text, $rating)
{
    $conn = connectToDatabase();

    try {
        $sql = "INSERT INTO reviews (username, review_text, rating, review_date) VALUES (?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);


        $stmt->execute([$username, $review_text, $rating]);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    closeDatabaseConnection($conn);
}


function deleteReviewsByUsername($username)
{
    $conn = connectToDatabase();

    try {
        $sql = "DELETE FROM reviews WHERE username = ?";
        $stmt = $conn->prepare($sql);

        $stmt->execute([$username]);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    closeDatabaseConnection($conn);
}


?>
