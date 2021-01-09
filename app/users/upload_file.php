<?php

declare(strict_types=1);

require __DIR__ . '/../autoload.php';

if (isset($_FILES['image'])) {
    if (!empty($_FILES['image']['name'])) {
        // Get file info
        $fileName = basename($_FILES['image']['name']);
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

        // The allowed file-ends
        $allowTypes = ['jpg', 'png'];
        if (in_array($fileType, $allowTypes)) {
            if ($_FILES['image']['size'] >= 3145728) {
                $image = $_FILES['image']['tmp_name'];
                $imageContent = addslashes(file_get_contents($image));
                $statement = $pdo->prepare('UPDATE users SET avatar = :avatar WHERE email = :email');
                $statement->bindParam(':avatar', $imageContent, PDO::PARAM_LOB);
                $statement->bindParam(':email', $_SESSION['user']['email'], PDO::PARAM_STR);
                $statement->execute();
            }
        } else {
            $_SESSION['errors']['fileTypeError'] = "Wrong filetype";
        }
    }
    $_SESSION['errors']['noFileSelected'] = "No file selected";
}

redirect('/profile.php');
