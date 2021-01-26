<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>
<article>
    <h1><?php echo $config['title']; ?></h1>
    <p>You have entered the matrix.</p>
    <?php if (logged_in()) : ?>
        <p>Welcome, <?= $_SESSION['user']['username']; ?>!</p>
    <?php endif; ?>
</article>


<div class="post-container">
    <h1><?php if ($_SESSION['feed'] === 'mostUpvoted') {
            echo "Most upvoted posts";
        } else {
            echo "Newest posts";
        } ?></h1>
    <div class="feed-settings">
        <form action="/app/posts/newest.php" method="post">
            <button type="submit" name="submit" class="button3">Newest</button>
        </form>
        <form action="/app/posts/most_upvoted.php" method="post">
            <button type="submit" name="submit" class="button3">Most upvoted</button>
        </form>
    </div>
    <?php $posts = getPosts($pdo, 0); ?>
    <div>
        <?php foreach ($posts as $post) : ?>
            <article class="post">
                <p class="nmbr-votes"><?= getPostUpvotes($pdo, $post['post_id']) ?></p>
                <?php if (logged_in()) : ?>
                    <?php if (checkIfUpvoted($pdo, $post['post_id'])) : ?>
                        <form action="/app/posts/upvotes.php" method="post" class="votes">
                            <input type="hidden" name="post_id" id="post_id" value="<?= $post['post_id'] ?>">
                            <button type="submit" name="submit" id="submit" value="remove" class="votes-button">
                                <div class="arrow-up remove"></div>
                            </button>
                        </form>
                    <?php else : ?>
                        <form action="/app/posts/upvotes.php" method="post" class="votes add">
                            <input type="hidden" name="post_id" id="post_id" value="<?= $post['post_id'] ?>">
                            <button type="submit" name="submit" id="submit" value="add" class="votes-button">
                                <div class="arrow-up"></div>
                            </button>
                        </form>
                    <?php endif ?>
                <?php else : ?>
                    <div class="votes">
                        <button class="votes-button nonUserUpvote">
                            <div class="arrow-up"></div>
                        </button>
                    </div>
                <?php endif ?>
                <div class="link-text">
                    <a href="/views/post.php?post_id=<?= $post['post_id'] ?>" class="title"><?= $post['title'] ?></a>
                    <a href="<?= $post['link'] ?>" class="link">(<?= substr($post['link'], 8, 25) ?>...)</a>
                </div>
                <p class="created-by"><?= getUserByID($pdo, $post['user_id'])['username'] ?></p>
                <p class="created-at"><?= $post['created_at'] ?></p>
            </article>
        <?php endforeach ?>
    </div>
</div>

<?php require __DIR__ . '/views/footer.php'; ?>