<?php

use function PHPSTORM_META\elementType;

require dirname(__DIR__, 1) . '/app/autoload.php'; ?>
<?php require __DIR__ . '/header.php'; ?>

<?php if (!logged_in()) {
    redirect('/views/login.php');
    exit;
} ?>

<h1>Your profile</h1>


<div class="profile-top">
    <?php if (getProfileImage($pdo)) : ?>
        <img class="profile-image" src="<?= getProfileImage($pdo) ?>" alt="Your profile picture">
    <?php else : ?>
        <p class="no-profile-pic">No profile picture</p>
    <?php endif ?>

    <p><?= $_SESSION['user']['username'] ?></p>
</div>

<!-- Email -->
<form action="../app/users/update.php" method="post" class="profile-forms">
    <label for="email">Change your email.</label>
    <br>
    <input type="text" name="email" id="email" placeholder="<?= $_SESSION['user']['email'] ?>">
    <button type="submit" class="button3">Submit</button>
</form>

<!-- Password -->
<form action="../app/users/update.php" method="post" class="profile-forms">
    <div>
        <label for="old-pass">Change your password.</label>
        <br>
        <input type="password" name="old-pass" id="old-pass" placeholder="Old password">
        <small>Type your old password</small>
    </div>
    <div>
        <input type="password" name="new-pass" id="new-pass" placeholder="New password">
        <small>Type your new password</small>
    </div>
    <button type="submit" class="button3 space">Submit</button>
</form>

<!-- Description -->
<form action="../app/users/update.php" method="post" class="profile-forms">
    <label for="desc">Description</label>
    <br>
    <input type="text" name="desc" id="desc" placeholder="<?= $_SESSION['user']['description'] ?>">
    <small>Add/change your description</small>
    <br>
    <button type="submit" class="button3 space">Submit</button>
</form>

<!-- Profile picture -->
<form action="../app/users/upload_file.php" method="post" enctype="multipart/form-data" class="profile-forms">
    <label for="image">Avatar/profile image</label>
    <br>
    <input type="file" name="image" id="image" accept=".png, .jpg">
    <br>
    <small>Please upload either a .png or .jpg image</small>
    <br>
    <?php if (isset($errors['errors']['imageSize'])) : ?>
        <small class="error"> <?= $errors['errors']['imageSize'] ?></small>
        <br>
    <?php endif ?>
    <button type="submit" class="button3 space">Submit</button>
</form>

<!-- Delete -->
<form action="../app/users/delete.php" method="post" class="profile-forms">
    <label for="delete">Delete your account</label>
    <br>
    <input type="text" name="delete" id="delete" placeholder="DELETE">
    <small>Type DELETE to delete your account</small>
    <br>
    <button type="submit" class="button3 space">Delete</button>
    <?php if (isset($errors['notDelete'])) : ?>
        <small class="error"><?= $errors['notDelete'] ?></small>
    <?php endif ?>
</form>
<?php require __DIR__ . '/footer.php' ?>