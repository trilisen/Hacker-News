<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>You have entered the matrix.</p>

    <?php if (isset($_SESSION['user'])) : ?>
        <p>Welcome, <?php echo $_SESSION['user']['username']; ?>!</p>
    <?php endif; ?>
</article>

<div class="post-container">
    <ol>
        <?php $posts = getPosts($pdo, 0); ?>
        <?php die(var_dump($posts)); ?>
    </ol>
</div>

<?php require __DIR__ . '/views/footer.php'; ?>