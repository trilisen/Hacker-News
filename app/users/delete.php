<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (!logged_in()) {
    redirect('/views/login.php');
    exit;
}

if (isset($_POST['delete']) && $_POST['delete'] === 'DELETE') {
    // die(var_dump("DELETE", $_SESSION['user']['user_id']));
    $statement = $pdo->prepare('DELETE FROM users WHERE email = :email;');
    $statement->bindParam(':email', $_SESSION['user']['email'], PDO::PARAM_STR);
    $statement->execute();
    var_dump("User gone");
    $delete_comment_replies = $pdo->prepare('DELETE FROM comment_replies WHERE `user_id` = :userId;');
    $delete_comment_replies->bindParam(':userId', $_SESSION['user']['user_id'], PDO::PARAM_INT);
    $delete_comment_replies->execute();
    var_dump("replies gone");
    $delete_comments = $pdo->prepare('DELETE FROM comments WHERE `user_id` = :userId;');
    $delete_comments->bindParam(':userId', $_SESSION['user']['user_id'], PDO::PARAM_INT);
    $delete_comments->execute();
    var_dump("comments gone");
    $delete_posts = $pdo->prepare('DELETE FROM posts WHERE `user_id` = :userId;');
    $delete_posts->bindParam(':userId', $_SESSION['user']['user_id'], PDO::PARAM_INT);
    $delete_posts->execute();
    var_dump("post gone");
    $delete_votes = $pdo->prepare('DELETE FROM votes WHERE `user_id` = :userId;');
    $delete_votes->bindParam(':userId', $_SESSION['user']['user_id'], PDO::PARAM_INT);
    $delete_votes->execute();
    unset($_SESSION['user']);
    header('Location: logout.php');
} else {
    $_SESSION['errors']['notDelete'] = "Please type DELETE to delete your account";
    redirect('/views/profile.php');
}

redirect('/');
