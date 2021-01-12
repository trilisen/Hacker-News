<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php
if (!logged_in()) {
    redirect('/login.php');
    exit;
}
?>

<?php if (isset($_POST['submit'])) : ?>
    <form action="/app/comments/update.php" method="post">
        <div class="form-element">
            <textarea name="comment" id="comment" cols="30" rows="10"><?= $_POST['edit'] ?></textarea>
            <input type="hidden" name="post_id" value="<?= $_POST['post_id'] ?>">
            <button type="submit" name="submit" value="<?= $_POST['submit'] ?>">Submit changes</button>
        </div>
    </form>
<?php endif ?>

<?php require __DIR__ . '/views/footer.php'; ?>