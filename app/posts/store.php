<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we store new posts in the database.


if (isset($_POST['title'], $_POST['link'])) {
    $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
    if (filter_var($_POST['link'], FILTER_SANITIZE_URL) !== false) {
        $link = $_POST['link'];
        $user_id = $_SESSION['user']['user_id'];

        $date = date("d-m-Y/H:i:s");

        $statement = $pdo->prepare('INSERT INTO posts (user_id, title, created_at, link, votes) VALUES (:user_id, :title, :date, :link, 0)');
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $statement->bindParam(':title', $title, PDO::PARAM_STR);
        $statement->bindParam(':date', $date, PDO::PARAM_STR);
        $statement->bindParam(':link', $link, PDO::PARAM_STR);
        $statement->execute();

        redirect('/');
    }
}


redirect('/post.php');
