<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

// In this file we register a new user.
if (isset($_POST['username'], $_POST['email'], $_POST['password'], $_POST['pass-confirm'])) {
    if ($_POST['password'] === $_POST['pass-confirm']) {
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        email_in_use($email);
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Prepare, bind email parameter and execute the database query.
        $statement = $pdo->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
        $statement->bindParam(':email', $email, PDO::PARAM_STR);
        $statement->bindParam(':username', $username, PDO::PARAM_STR);
        $statement->bindParam(':password', $hash, PDO::PARAM_STR);
        $statement->execute();


        redirect('/app/users/login.php');
        // // Fetch the user as an associative array.
        // $user = $statement->fetch(PDO::FETCH_ASSOC);

        // // If we couldn't find the user in the database, redirect back to the login
        // // page with our custom redirect function.
        // if (!$user) {
        //     redirect('/register.php');
        // }

        // // If we found the user in the database, compare the given password from the
        // // request with the one in the database using the password_verify function.
        // if (password_verify($_POST['password'], $user['password'])) {
        //     // If the password was valid we know that the user exists and provided
        //     // the correct password. We can now save the user in our session.
        //     // Remember to not save the password in the session!
        //     unset($user['password']);

        //     $_SESSION['user'] = $user;
        // }
    } else {
        // Some error message maybe redirect function, but rework that one
    }
}

redirect('/');
