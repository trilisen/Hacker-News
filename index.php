<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>You have entered the matrix.</p>

    <?php if (logged_in()) : ?>
        <p>Welcome, <?php echo $_SESSION['user']['username']; ?>!</p>
    <?php endif; ?>
</article>

<div class="post-container">
    <ol>
        <?php $posts = getPosts($pdo, 0); ?>
        <?php foreach ($posts as $post) : ?>
            <p><?= $post['votes'] ?></p>
            <a href="<?php redirect('/') ?>"><?= $post['title'] ?></a>
            <a href="<?= $post['link'] ?>"><?= $post['link'] ?></a>
            <p>Created on <?= $post['created_at'] ?></p>
        <?php endforeach ?>
    </ol>
</div>

<?php require __DIR__ . '/views/footer.php'; ?>