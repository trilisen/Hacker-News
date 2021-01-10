<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php if (!logged_in()) {
    redirect('/login.php');
} ?>

<h1>Your profile</h1>

<?php
// $statement = $pdo->prepare("SELECT avatar FROM users WHERE email = :email");
// $statement->bindParam(':email', $_SESSION['user']['email'], PDO::PARAM_STR);
// $statement->execute();

// $result = $statement->fetch(PDO::FETCH_ASSOC);
// $encode = base64_encode($result['avatar']);
// $decode = base64_decode($encode);
// die(var_dump($decode));
// die(var_dump($encode));
?>

<!-- <img src="data:image/png;charset=utf8;base64, alt="Your profile picture"> -->


<p><?= $_SESSION['user']['username'] ?></p>
<form action="/app/users/update.php" method="post">

    <form action=""></form>
</form>
<form action="/app/users/update.php" method="post">
    <label for="email">Change your email.</label>
    <br>
    <input type="text" name="email" id="email" placeholder="<?= $_SESSION['user']['email'] ?>">
    <button type="submit">Submit</button>
</form>
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
<form action="/app/users/update.php" method="post">
    <label for="desc">Description</label>
    <br>
    <input type="text" name="desc" id="desc" placeholder="<?= $_SESSION['user']['description'] ?>">
    <small>Add/change your description</small>
    <br>
    <button type="submit">Submit</button>
</form>
<form action="/app/users/upload_file.php" method="post" enctype="multipart/form-data">
    <label for="image">Avatar/profile image</label>
    <br>
    <input type="file" name="image" id="image" accept=".png, .jpg">
    <small>Please upload either a .png or .jpg image</small>
    <br>
    <?php if (isset($_SESSION['errors']['fileTypeError'])) : ?>
        <small><?= $_SESSION['errors']['fileTypeError'] ?></small>
        <br>
    <?php elseif (isset($_SESSION['errors']['noFileSelected'])) : ?>
        <small> <?= $_SESSION['errors']['noFileSelected'] ?></small>
        <br>
    <?php endif ?>
    <button type="submit">Submit</button>
</form>

<form action="/app/users/delete.php" method="post">
    <label for="delete">Delete your account</label>
    <br>
    <input type="text" name="delete" id="delete" placeholder="delete">
    <small>Type delete to delete your account</small>
    <br>
    <button type="submit">Delete</button>
</form>
<?php require __DIR__ . '/views/footer.php' ?>