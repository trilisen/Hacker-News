<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we register a new user.
if (isset($_POST['username'], $_POST['regEmail'], $_POST['regPassword'], $_POST['pass-confirm'])) {
    if ($_POST['regPassword'] === $_POST['pass-confirm']) {
        $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
        $email = trim(filter_var($_POST['regEmail'], FILTER_SANITIZE_EMAIL));
        $password = trim(filter_var($_POST['regPassword'], FILTER_SANITIZE_STRING));
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Find if email already exists
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
