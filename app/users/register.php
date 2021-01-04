<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we register a new user.
if (isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['pass-confirm'])) {
    if ($_POST['password'] === $_POST['pass-confirm']) {
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        $email_check = $statement->fetch(PDO::FETCH_ASSOC);
        if (!$email_check) {
            $statement = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->bindParam(':username', $username, PDO::PARAM_STR);
            $statement->bindParam(':password', $hash, PDO::PARAM_STR);
            $statement->execute();

            $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
            $statement->bindParam(':email', $email, PDO::PARAM_STR);
            $statement->execute();

            // Fetch the user as an associative array.
            $user = $statement->fetch(PDO::FETCH_ASSOC);

            unset($user['password']);

            $_SESSION['user'] = $user;
        } else {
            redirect('/login.php'); // That email is already in use
        }
    } else {
        redirect('/login.php'); // Passwords don't match
    }
}

redirect('/');
