<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (!logged_in()) {
    redirect('/login.php');
}

if (isset($_POST['delete']) && $_POST['delete'] === 'delete') {
    $statement = $pdo->prepare('DELETE FROM users WHERE email = :email');
    $statement->bindParam(':email', $_SESSION['user']['email'], PDO::PARAM_STR);
    $statement->execute();

    unset($_SESSION['user']);
}

redirect('/');
