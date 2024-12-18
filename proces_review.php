<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('otzivi_proces.php');

    $username = $_POST['username'];
    $review_text = $_POST['review_text'];
    $rating = $_POST['rating'];

    addReview($username, $review_text, $rating);

    header("Location: otzivi_main.php");
    exit();
}
?>
