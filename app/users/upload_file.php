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
}

redirect('/profile.php');
