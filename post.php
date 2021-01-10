<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php if (!logged_in()) {
    redirect('/login.php');
} ?>

<?php require __DIR__ . '/views/footer.php'; ?>