<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we update posts in the database.

if (!logged_in()) {
    redirect('/login.php');
}

$post_id = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);

if (isset($_POST['title'])) {
    $title = trim(filter_var($_POST['title'], FILTER_SANITIZE_STRING));
    $statement = $pdo->prepare('UPDATE posts SET title = :title WHERE post_id = :post_id');
    $statement->bindParam(':title', $title, PDO::PARAM_STR);
    $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement->execute();
}

if (isset($_POST['link'])) {
    $link = trim(filter_var($_POST['link'], FILTER_SANITIZE_URL));
    $statement = $pdo->prepare('UPDATE posts SET link = :link WHERE post_id = :post_id');
    $statement->bindParam(':link', $link, PDO::PARAM_STR);
    $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $statement->execute();
}

redirect('/post.php?post_id=' . $post_id);
