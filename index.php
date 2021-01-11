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
            <a href="/post.php?post_id=<?= $post['post_id'] ?>"><?= $post['title'] ?></a>
            <form action="/post.php" method="post">
                <input type="hidden" name="post_id" id="post_id" value="<?= $post['post_id'] ?>">
                <button type="submit" class="titleButton"><?= $post['title'] ?></button>
            </form>
            <a href="<?= $post['link'] ?>"><?= $post['link'] ?></a>
            <p>Created on <?= $post['created_at'] ?></p>
        <?php endforeach ?>
    </ol>
</div>

<?php require __DIR__ . '/views/footer.php'; ?>