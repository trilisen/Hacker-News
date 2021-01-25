<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (!logged_in()) {
    redirect('/login.php');
    exit;
}

if (isset($_POST['comment'])) {
    $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);
    if (isset($_POST['reply'])) {
        // Fix editable 
    }
    $statement = $pdo->prepare('UPDATE comments SET content = :content, created_at = :date WHERE comment_id = :comment_id');
    $statement->bindParam(':content', $comment, PDO::PARAM_STR);
    $statement->bindParam(':comment_id', $_POST['submit'], PDO::PARAM_INT);
    $statement->bindParam(':date', date("d-m-Y/H:i:s"), PDO::PARAM_STR);
    $statement->execute();
}

redirect('/views/post.php?post_id=' . $_POST['post_id']);
