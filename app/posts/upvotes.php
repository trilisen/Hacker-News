<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (!logged_in()) {
    redirect('/views/login.php');
    exit;
}
$post_id = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);

if (isset($_POST['submit'])) {
    if ($_POST['submit'] === 'add') {
        // Add vote
        $statement = $pdo->prepare('INSERT INTO votes (post_id, user_id) VALUES (:post_id, :user_id)');
        $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
        $statement->execute();
    } elseif ($_POST['submit'] == 'remove') {
        // Delete vote
        $statement = $pdo->prepare('DELETE FROM votes WHERE post_id = :post_id AND user_id = :user_id');
        $statement->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
        $statement->execute();
    }
}

if (isset($_POST['onPost'])) {
    redirect('/views/post.php?post_id=' . $post_id);
}

redirect('/');
