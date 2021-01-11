<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete new posts in the database.

if (!logged_in()) {
    redirect('/login.php');
}
$post_id = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);
$statement = $pdo->prepare('DELETE FROM posts WHERE post_id = :post_id');
$statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
$statement->execute();

redirect('/');
