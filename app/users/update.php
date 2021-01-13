<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (!logged_in()) {
    redirect('/views/login.php');
    exit;
}

if (isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);

    // Find if email already exists
    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();
    $email_check = $statement->fetch(PDO::FETCH_ASSOC);
    if (!$email_check) {
        $statement = $pdo->prepare('UPDATE users SET email = :email WHERE email = :old');
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':old', $_SESSION['user']['email'], PDO::PARAM_STR);
        $statement->execute();

        $_SESSION['user']['email'] = $email;
    }
}

if (isset($_POST['old-pass'], $_POST['new-pass'])) {
    $old_pass = filter_var($_POST['old-pass'], FILTER_SANITIZE_STRING);
    $new_pass = filter_var($_POST['new-pass'], FILTER_SANITIZE_STRING);
    $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);

    $statement = $pdo->prepare('SELECT password FROM users WHERE email = :email');
    $statement->bindParam(':email', $_SESSION['user']['email'], PDO::PARAM_STR);
    $statement->execute();
    $user_password = $statement->fetch(PDO::FETCH_ASSOC);
    if (password_verify($_POST['old-pass'], $user_password['password'])) {
        $statement = $pdo->prepare('UPDATE users SET password = :password WHERE email = :email');
        $statement->bindParam(':password', $new_pass, PDO::PARAM_STR);
        $statement->bindParam(':email', $_SESSION['user']['email'], PDO::PARAM_STR);
        $statement->execute();
    }
    unset($old_pass, $new_pass, $user_password, $_SESSION['user']);
}

if (isset($_POST['desc'])) {
    $desc = filter_var($_POST['desc'], FILTER_SANITIZE_STRING);

    $statement = $pdo->prepare('UPDATE users SET description = :description WHERE email = :email');
    $statement->bindParam(':description', $desc, PDO::PARAM_STR);
    $statement->bindParam(':email', $_SESSION['user']['email'], PDO::PARAM_STR);
    $statement->execute();

    $_SESSION['user']['description'] = $desc;
}


// Maybe split into different files?
redirect('/views/profile.php');
