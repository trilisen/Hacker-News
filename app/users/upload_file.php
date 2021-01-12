<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (!logged_in()) {
    redirect('/login.php');
    exit;
}

if (isset($_FILES['image'])) {
    $image = $_FILES['image'];
    if ($image['size'] >= 3145728) {
        $_SESSION['errors']['imageSize'] = "The uploaded image exceeds the filesize limit of 32MB";
        redirect('/profile.php');
        exit;
    }
    $destination = __DIR__ . '/uploads/' . date('ymd') . '-' . $image['name'];

    move_uploaded_file($image['tmp_name'], $destination);

    if (getProfileImage($pdo)) {
        $oldImageDest = __DIR__ . str_replace("/app/users", "", getProfileImage($pdo));
        unlink($oldImageDest);
    }

    $destination = '/app/users/uploads/' . date('ymd') . '-' . $image['name'];
    $statement = $pdo->prepare('UPDATE users SET avatar = :avatar WHERE user_id = :user_id');
    $statement->bindParam(':avatar', $destination, PDO::PARAM_STR);
    $statement->bindParam(':user_id', $_SESSION['user']['user_id'], PDO::PARAM_INT);
    $statement->execute();
}

redirect('/profile.php');
