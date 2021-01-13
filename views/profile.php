<?php

use function PHPSTORM_META\elementType;

require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php if (!logged_in()) {
    redirect('/views/login.php');
    exit;
} ?>

<h1>Your profile</h1>


<?php if (getProfileImage($pdo)) : ?>
    <img class="profileImage" src="<?= getProfileImage($pdo) ?>" alt="Your profile picture">
<?php else : ?>
    <p>No profile picture</p>
<?php endif ?>

<p><?= $_SESSION['user']['username'] ?></p>

<!-- Email -->
<form action="/app/users/update.php" method="post">
    <label for="email">Change your email.</label>
    <br>
    <input type="text" name="email" id="email" placeholder="<?= $_SESSION['user']['email'] ?>">
    <button type="submit">Submit</button>
</form>

<!-- Password -->
<form action="/app/users/update.php" method="post">
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
    <button type="submit">Submit</button>
</form>

<!-- Description -->
<form action="/app/users/update.php" method="post">
    <label for="desc">Description</label>
    <br>
    <input type="text" name="desc" id="desc" placeholder="<?= $_SESSION['user']['description'] ?>">
    <small>Add/change your description</small>
    <br>
    <button type="submit">Submit</button>
</form>

<!-- Profile picture -->
<form action="/app/users/upload_file.php" method="post" enctype="multipart/form-data">
    <label for="image">Avatar/profile image</label>
    <br>
    <input type="file" name="image" id="image" accept=".png, .jpg">
    <small>Please upload either a .png or .jpg image</small>
    <br>
    <?php if (isset($_SESSION['errors']['imageSize'])) : ?>
        <small> <?= $_SESSION['errors']['imageSize'] ?></small>
        <br>
    <?php endif ?>
    <button type="submit">Submit</button>
</form>

<!-- Delete -->
<form action="/app/users/delete.php" method="post">
    <label for="delete">Delete your account</label>
    <br>
    <input type="text" name="delete" id="delete" placeholder="delete">
    <small>Type delete to delete your account</small>
    <br>
    <button type="submit">Delete</button>
</form>
<?php require __DIR__ . '/views/footer.php' ?>