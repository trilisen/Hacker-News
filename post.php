<?php require __DIR__ . '/app/autoload.php'; ?>
<?php require __DIR__ . '/views/header.php'; ?>

<?php if (!logged_in()) {
    redirect('/login.php');
}; ?>

<?php if (isset($_POST['post_id'])) : ?>
    <?php $post_info = getPostInfo($pdo, $_POST['post_id']) ?>

    <form action="/app/posts/update.php" method="post">
        <!-- Title -->
        <?php if ($_SESSION['user']['user_id'] === $post_info['user_id']) : ?>
            <input type="text" name="title" id="title" value="<?= $post_info['title'] ?>">
        <?php else : ?>
            <h1><?= $post_info['title'] ?></h1>
        <?php endif ?>

        <!-- Votes -->
        <p><?= $post_info['votes'] ?></p>

        <!-- Url/link -->
        <?php if ($_SESSION['user']['user_id'] === $post_info['user_id']) : ?>
            <input type="url" name="link" id="link" value="<?= $post_info['link'] ?>">
        <?php else : ?>
            <a href="<?= $post_info['link'] ?>"><?= $post_info['link'] ?></a>
        <?php endif ?>

        <!-- Date -->
        <p>Created on: <?= $post_info['created_at'] ?></p>

        <!-- Created by -->
        <p>Post by: <?= getUserByID($pdo, $post_info['user_id'])['username'] ?></p>

        <!-- Commit changes -->
        <?php if ($_SESSION['user']['user_id'] === $post_info['user_id']) : ?>
            <input type="hidden" name="post_id" id="post_id" value="<?= $post_info['post_id'] ?>">
            <button type="submit">Submit changes</button>
        <?php endif ?>

    </form>
    <!-- Delete post -->
    <?php if ($_SESSION['user']['user_id'] === $post_info['user_id']) : ?>
        <form action="/app/posts/delete.php" method="post">
            <input type="hidden" name="post_id" id="post_id" value="<?= $post_info['post_id'] ?>">
            <button type="submit">Delete post</button>
        </form>
    <?php endif ?>


<?php endif ?>

<?php require __DIR__ . '/views/footer.php'; ?>