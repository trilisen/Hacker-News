<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (!logged_in()) {
    redirect('/login.php');
    exit;
}

if (isset($_POST['submit']) && $_POST['submit'] !== "delete_reply") {
    $comment_id = filter_var($_POST['submit'], FILTER_VALIDATE_INT);

    $statement = $pdo->prepare('DELETE FROM comments WHERE comment_id = :comment_id');
    $statement->bindParam(':comment_id', $comment_id, PDO::PARAM_INT);
    $statement->execute();
} else if ($_POST['submit'] === "delete_reply") {
    $reply_id = filter_var($_POST['reply_id'], FILTER_VALIDATE_INT);
    // die(var_dump("DEleteing reply..."));
    $statement = $pdo->prepare('DELETE FROM comment_replies WHERE id = :reply_id');
    $statement->bindParam(':reply_id', $reply_id, PDO::PARAM_INT);
    $statement->execute();
}

redirect('/views/post.php?post_id=' . $_POST['post_id']);
