<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (!logged_in()) {
    redirect('/views/login.php');
    exit;
}

if (isset($_POST['delete']) && $_POST['delete'] === 'DELETE') {
    $statement = $pdo->prepare('DELETE FROM users WHERE email = :email');
    $statement->bindParam(':email', $_SESSION['user']['email'], PDO::PARAM_STR);
    $statement->execute();

    unset($_SESSION['user']);
} else {
    $_SESSION['errors']['notDelete'] = "Please type DELETE to delete your account";
    redirect('/views/profile.php');
}

redirect('/');
