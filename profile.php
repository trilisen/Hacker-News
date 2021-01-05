<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<h1>Your profile</h1>

<p><?= $_SESSION['user']['username'] ?></p>
<p><?= $_SESSION['user']['email'] ?></p>
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
        <input type="text" name="old-pass" id="old-pass" placeholder="Old password">
        <small>Type your old password</small>
    </div>
    <div>
        <input type="text" name="new-pass" id="new-pass" placeholder="New password">
        <small>Type your new password</small>
    </div>
    <button type="submit">Submit</button>
</form>
<?php require __DIR__ . '/views/footer.php' ?>