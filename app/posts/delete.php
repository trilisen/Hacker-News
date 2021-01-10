<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we delete new posts in the database.

if (!logged_in()) {
    redirect('/login.php');
}

$statement = $pdo->prepare('DELETE FROM posts WHERE post_id = :post_id');
$statement->bindParam(':post_id', $_POST['post_id'], PDO::PARAM_INT);
$statement->execute();

redirect('/');
